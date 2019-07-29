<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class: my_health
 * User: John Muchiri
 * Email: jgmuchiri@gmail.com
 * Date: 11/29/2014
 *
 * https://amdtllc.com
 * Copyright 2014 All Rights Reserved
 */
class My_food extends CI_Model
{

    /**
     * @return bool
     */
    function newPref()
    {
        $food = $this->input->post('food');
        $child_id = $this->input->post('child_id');
        $data = array(
            'child_id' => $child_id,
            'food' => $food,
            'food_time' => $this->input->post('food_time'),
            'comment' => $this->input->post('comment'),
            'created_at' => date_stamp(),
            'user_id' => $this->user->uid()
        );
        if($this->db->insert('child_foodpref', $data)) {
            $last_id = $this->db->insert_id();
            //log
            logEvent($id = NULL,"Added food pref {$food} for child {$this->child->child($child_id)->first_name}",$care_id = NULL);
            //notify parent
            $this->parent->notifyParents($data['child_id'], lang('new_foodpref_subject'), lang('new_foodpref_message'));
            return true;
        }
        return false;
    }

    /**
     * @param $childID
     *
     * @return mixed
     */
    function getIntake($childID)
    {
        return $this->db->where('child_id', $childID)
            ->get('child_food_intake')->result();
    }

    /**
     * @return bool
     */
    function recordIntake()
    {
        $date = date('Y-m-d', strtotime($this->input->post('date')));
        $date = $date.' '.date('H:i:s', strtotime($this->input->post('time')));
        $child_id = $this->input->post('child_id');
        $meal_time = $this->input->post('meal_time');
        $this->db->insert('child_food_intake',
            [
                'child_id' => $child_id,
                'user_id' => user_id(),
                'taken_at' => $date,
                'quantity' => $this->input->post('quantity'),
                'meal_time' => $meal_time,
                'remarks' => $this->input->post('remarks')
            ]);

        if($this->db->affected_rows() > 0) {
            $last_id = $this->db->insert_id();
            logEvent($user_id = NULL,"Added food intake recorded for child {$this->child->child($child_id)->first_name}",$care_id = NULL);
            $this->parent->notifyParents($child_id, lang('Food Intake'), '<p style="font-size: 15px;">Food intake recorded for one of your child.</p>');

            //update attendance
            $data = [
                'child_id' => $this->input->post('child_id'),
                'meal_time' => $this->input->post('meal_time'),
                'created_at' => $date
            ];
            $this->updateFoodReport($data);

            return true;
        }

        return false;
    }

    function updateFoodReport($data)
    {

        $res = $this->db
            ->where('child_id', $data['child_id'])
            ->where('created_at', date('Y-m-d', strtotime($data['created_at'])))
            ->get('form_ny_attendance')->row();

        if(count((array)$res) > 0) { //record exists then update

            if(!is_array($res->food)) {
                $res->food = [];
                foreach ($this->mealTimes() as $time) {
                    $res->food[$time] = false;
                }

                $res->food = serialize($res->food);
            }

            $arr = unserialize($res->food);

            if(array_key_exists($data['meal_time'], $arr)) {
                $arr[$data['meal_time']] = true;
            }

            $data['food'] = serialize($arr);
            unset($data['meal_time']);
            $data['updated_at'] = date_stamp();

            $this->db
                ->where('child_id', $data['child_id'])
                ->where('created_at', date('Y-m-d'))
                ->update('form_ny_attendance', $data);
                logEvent($user_id = NULL,"Food intake updated for form_ny_attendance of child {$this->child->child($data['child_id'])->first_name}",$care_id = NULL);
        } else {

            $mealTimes = $this->mealTimes();
            $times = [];

            foreach ($mealTimes as $time) {
                $times[$time] = false;
                if($data['meal_time'] == $time)
                    $times[$time] = true;
            }
            unset($data['meal_time']);

            $data['food'] = serialize($times);
            $data['created_at'] = date('Y-m-d');
            $data['updated_at'] = date_stamp();
            $this->db->insert('form_ny_attendance', $data);
            $last_id = $this->db->insert_id();
            logEvent($user_id = NULL,"Food intake added for form_ny_attendance of child {$this->child->child($data['child_id'])->first_name}",$care_id = NULL);
        }
    }

    function mealTimes()
    {
        return ['B', 'AM', 'L', 'PM', 'S', 'EV'];
    }

    function mealTime($time)
    {
        switch ($time) {
            case "B":
                $time = lang('breakfast');
                break;
            case "AM":
                $time = lang('AM Snack');
                break;
            case "L":
                $time = lang('Lunch');
                break;
            case "PM":
                $time = lang('PM Snack');
                break;
            case "S":
                $time = lang('Supper');
                break;
            case "EV":
                $time = lang('Evening Snack');
                break;
            default:
                $time = "";
                break;

        }
        return $time;
    }
}