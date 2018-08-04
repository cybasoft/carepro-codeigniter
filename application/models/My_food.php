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

    function __construct()
    {
        parent::__construct();
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

        $this->db->insert('child_food_intake',
            [
                'child_id' => $this->input->post('child_id'),
                'user_id' => user_id(),
                'taken_at' => $date,
                'quantity' => $this->input->post('quantity'),
                'meal_time' => $this->input->post('meal_time'),
                'remarks' => $this->input->post('remarks')
            ]);

        if($this->db->affected_rows() > 0)
            return true;

        return false;
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