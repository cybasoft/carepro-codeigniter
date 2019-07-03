<?php

class My_activity extends CI_Model
{

    /**
     * @return bool
     */
    function insert()
    {
        $data = [
            'room_id' => $this->input->post('room_id'),
            'name' => $this->input->post('name'),
            'activity_date' => $this->input->post('activity_date'),
            'activity_start' => $this->input->post('activity_start'),
            'activity_end' => $this->input->post('activity_end'),
            'description' => $this->input->post('description'),
            'user_id' => user_id(),
            'created_at' => date_stamp(),
            'updated_at' => date_stamp(),
        ];
        if($this->db->insert('activity_plan', $data))
            $last_id = $this->db->insert_id();
            logEvent($user_id = NULL,"Added activity ID: {$last_id} for room ID:{$this->input->post('room_id')}",$care_id = NULL);
            return TRUE;
        return FALSE;
    }


    function update($id){
        $data = [
            'name' => $this->input->post('name'),
            'activity_date' => $this->input->post('activity_date'),
            'activity_start' => $this->input->post('activity_start'),
            'activity_end' => $this->input->post('activity_end'),
            'description' => $this->input->post('description'),
            'updated_at' => date_stamp(),
        ];
        if($this->db->where('id',$id)->update('activity_plan', $data))
            logEvent($user_id = NULL, "Updated activity ID: {$id} for room ID: {$this->input->post('room_id')}",$care_id = NULL);
            return TRUE;
        return FALSE;
    }
    function getActivity($day,$hour, $activities)
    {
        $acts = [];

        foreach ($activities as $activity) {
            if(date('h',strtotime($activity['activity_start'])) == $hour && $activity['activity_date'] == $day) {
                $acts[] = $activity;
            }
        }
        return $acts;
    }

    /**
     * @return mixed
     */
    function activities($id)
    {
        if(isset($_GET['week']) && $_GET['week'] !== "") {
            $date = $_GET['week'];
            $end_date = date('Y-m-d', strtotime("{$date} +6 days"));
            $result = $this->db
                ->where('activity_date >=', $date)
                ->where('activity_date <=', $end_date)
                ->where('room_id',$id)
                ->get('activity_plan')
                ->result_array();
        } else {
            $monday = date('Y-m-d', strtotime('monday this week'));
            $result = $this->db
                ->where('activity_date >=', $monday)
                ->where('activity_date <=', date('Y-m-d', strtotime('monday this week +6 days')))
                ->where('room_id',$id)
                ->get('activity_plan')
                ->result_array();
        }
        return $result;
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
        $activities = $this->db->where('activity_date >=', $monday)->where('activity_date <=', date('Y-m-d', strtotime('monday this week +6 days')))->get('activity_plan')->result();

        //clean next week
        $this->db->where('activity_date >=', date('Y-m-d', strtotime('monday next week')))->where('activity_date <=', date('Y-m-d', strtotime('monday next week +6 days')))->delete('activity_plan');

        foreach ($activities as $activity) {
            $data = [
                'room_id' => $activity->room_id,
                'name' => $activity->name,
                'activity_date' => date('Y-m-d', strtotime("{$activity->activity_date} +7 days")),
                'activity_start'=>$activity->activity_start,
                'activity_end'=>$activity->activity_end,
                'description' => $activity->description,
                'user_id' => $activity->user_id,
                'created_at' => date_stamp(),
                'updated_at' => date_stamp(),
            ];
            $this->db->insert('activity_plan', $data);
            $last_id = $this->db->insert_id();
            logEvent($user_id = NULL, "Copied activity plan ID: {$last_id} for next week of room ID: {$activity->room_id}",$care_id = NULL);
        }
        return TRUE;
    }

    /**
     * @param null $date
     */
    function clear($date = NULL)
    {
        if($date == NULL) {
            $this->db->where('activity_date >=', date('Y-m-d', strtotime('monday this week')))->where('activity_date <=', date('Y-m-d', strtotime('monday this week +6 days')))->delete('activity_plan');
        } else {
            $this->db->where('activity_date >=', $date)->where('activity_date <=', date('Y-m-d', strtotime("{$date} + 6 days")))->delete('activity_plan');
        }
    }
}