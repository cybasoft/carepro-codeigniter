<?php if(!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class My_children extends CI_Model
{

    public function checkedInChildren($daycare_id)
    {
        // $this->db->distinct();
        // $this->db->select('c.*,cc.time_in,cc.time_out,cc.in_guardian,cc.out_guardian,cc.in_staff_id,cc.out_staff_id,cc.remarks');
        // $this->db->from('children AS c');
        // $this->db->join('child_checkin as cc', 'cc.child_id=c.id');
        // $this->db->where('cc.time_out', null);
        // $this->db->where('DATE(cc.time_in)', date('Y-m-d'));
        // // $this->db->where('id', $id);
        // return $this->db->get()->result();
        $daycare_details = $this->db->get_where('daycare',array(
             'daycare_id' => $daycare_id
        ));
        $daycare = $daycare_details->row_array();      
        $res = $this->db
            ->select('c.*,cc.time_in,cc.time_out,cc.in_guardian,cc.out_guardian,cc.in_staff_id,cc.out_staff_id,cc.remarks, ca.allergy_count, cm.med_count')
            ->from('children AS c')
            ->where('c.daycare_id',$daycare['id'])
            ->join('child_checkin as cc', 'cc.child_id=c.id', 'left')
            ->join('(SELECT child_id,  COUNT(*) as allergy_count FROM child_allergy GROUP BY child_id) ca', 'c.id=ca.child_id', 'left')
            ->join('(SELECT child_id, COUNT(*) AS med_count FROM child_meds GROUP BY child_id) cm', 'cm.child_id=c.id', 'left')
            ->where('c.checkin_status', 1)
            ->where('cc.time_out', NULL)
            ->group_by('c.id')
            ->get();

        if(count($res->result_array()) > 0)
            return $res->result();

        return [];
    }

    public function checkedOutChildren($daycare_id)
    {
        $daycare_details = $this->db->get_where('daycare',array(
            'daycare_id' => $daycare_id
       ));
       $daycare = $daycare_details->row_array();      
        $res = $this->db
            ->select('c.*,cc.last_checkin')
            ->from('children AS c')
            ->where('c.daycare_id',$daycare['id'])
            ->join('(SELECT child_id,time_in AS last_checkin FROM child_checkin ORDER BY time_in DESC LIMIT 1) cc', 'cc.child_id=c.id', 'left')
            ->where('c.checkin_status', 0)
            ->get()->result();

        return $res;
    }

    public function inactiveChildren($daycare_id)
    {
        $daycare_details = $this->db->get_where('daycare',array(
            'daycare_id' => $daycare_id
       ));
       $daycare = $daycare_details->row_array();

        return $this->db->where([
                'status' => 0, 
                'daycare_id' => $daycare['id']
        ])->get('children')->result();
    }

    public function checkinTimer($dateTimeIn = NULL)
    {
        $count = time_difference($dateTimeIn, date('Y-m-d H:i:s'))->h.' '.lang('hrs').
            ' '.time_difference($dateTimeIn, date('Y-m-d H:i:s'))->i.' '.lang('mins');

        return $count;
    }

    public function checkin_count()
    {
        return $this->db->where('checkin_status', 1)->from('children')->count_all_results();
    }

    public function checkout_count()
    {
        return $this->db->where('checkin_status', 0)->from('children')->count_all_results();
    }
}
