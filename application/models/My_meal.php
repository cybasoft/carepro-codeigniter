<?php

class My_meal extends CI_Model
{

    /**
     * @return bool
     */
    function insert()
    {
        $data = [
            'room_id' => $this->input->post('room_id'),
            'meal_type' => $this->input->post('meal_type'),
            'name' => $this->input->post('name'),
            'meal_date' => $this->input->post('meal_date'),
            'user_id' => $this->input->post('user_id'),
            'created_at' => date_stamp(),
            'updated_at' => date_stamp(),
        ];
        if($this->db->insert('meal_plan', $data))
            return TRUE;
        return FALSE;
    }

    /**
     * @param $type
     * @param $day
     * @param $meals
     *
     * @return array
     */
    function getMeal($type, $day, $meals)
    {
        $theMeal = [];
        foreach ($meals as $meal) {
            if($meal['meal_type'] == $type && $meal['meal_date'] == $day) {
                $theMeal[] = $meal;
            }
        }
        return $theMeal;
    }

    /**
     * @return mixed
     */
    function meals()
    {
        if(isset($_GET['week']) && $_GET['week'] !==""){
            $date = $_GET['week'];
            $end_date = date('Y-m-d', strtotime("{$date} +6 days"));
            $result = $this->db
                ->where('meal_date >=', $date)
                ->where('meal_date <=', $end_date)
                ->get('meal_plan')
                ->result_array();
        }else{
            $monday = date('Y-m-d', strtotime('monday this week'));
            $result = $this->db
                ->where('meal_date >=', $monday)
                ->where('meal_date <=', date('Y-m-d', strtotime('monday this week +6 days')))
                ->get('meal_plan')
                ->result_array();
        }
        return $result;
    }

    /**
     * @return mixed
     */
    function mealTypes()
    {
        return $this->db->get('meal_plan_types')->result();
    }

    function days()
    {
        return [
            0 => lang('Monday'),
            1 => lang('Tuesday'),
            2 => lang('Wednesday'),
            3 => lang('Thursday'),
            4 => lang('Friday'),
            5 => lang('Saturday'),
            6 => lang('Sunday'),
        ];
    }

    /**
     * @return bool
     */
    function copy()
    {
        $monday = date('Y-m-d', strtotime('monday this week'));
        $meals = $this->db->where('meal_date >=', $monday)->where('meal_date <=', date('Y-m-d', strtotime('monday this week +6 days')))->get('meal_plan')->result();

        //clean next week
        $this->db->where('meal_date >=', date('Y-m-d', strtotime('monday next week')))->where('meal_date <=', date('Y-m-d', strtotime('monday next week +6 days')))->delete('meal_plan');

        foreach ($meals as $meal) {
            $data = [
                'room_id' => $meal->room_id,
                'meal_type' => $meal->meal_type,
                'name' => $meal->name,
                'meal_date' => date('Y-m-d', strtotime("{$meal->meal_date} +7 days")),
                'user_id' => $meal->user_id,
                'created_at' => date_stamp(),
                'updated_at' => date_stamp(),
            ];
            $this->db->insert('meal_plan', $data);
        }
        return TRUE;
    }

    /**
     * @param null $date
     */
    function clear($date = NULL)
    {
        if($date == NULL) {
            $this->db->where('meal_date >=', date('Y-m-d', strtotime('monday this week')))->where('meal_date <=', date('Y-m-d', strtotime('monday this week +6 days')))->delete('meal_plan');
        } else {
            $this->db->where('meal_date >=', $date)->where('meal_date <=', date('Y-m-d', strtotime("{$date} + 6 days")))->delete('meal_plan');
        }
    }
}