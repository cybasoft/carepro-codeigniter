<?php

if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @package     daycarepro app
 * @copyright   2018 A&M Digital Technologies
 * @author      John Muchiri
 * @link        https://amdtllc.com
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */
class ActivityController extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        //redirect session
        setRedirect();
        auth(TRUE);
        $this->load->model('My_activity', 'activity');
    }

    function create()
    {
        allow(['admin', 'manager', 'staff']);
        $this->form_validation->set_rules('name', lang('Activity name'), 'required|trim|xss_clean');
        if($this->form_validation->run() == TRUE) {
            if($this->activity->insert()) {
                flash('success', lang('Activity added'));
            } else {
                flash('error', lang('request_error'));
            }

        } else {
            validation_errors();
            flash('error');
        }
        redirectPrev(NULL, 'activities');
    }

    function update(){
        allow(['admin', 'manager', 'staff']);
        $this->form_validation->set_rules('name', lang('Activity name'), 'required|trim|xss_clean');
        $this->form_validation->set_rules('activity_date', lang('Date'), 'required|trim|xss_clean');
        $this->form_validation->set_rules('activity_start', lang('Time'), 'required|trim|xss_clean');
        if($this->form_validation->run() == TRUE) {
            if($this->activity->update(uri_segment(3))) {
                flash('success', lang('Activity updated'));
            } else {
                flash('error', lang('request_error'));
            }

        } else {
            validation_errors();
            flash('error');
        }
        redirectPrev(NULL, 'activities');
    }

    function delete()
    {
        allow(['admin', 'manager', 'staff']);
        $id = uri_segment(3);
        $activity_details = $this->db->get_where('activity_plan',array(
            'id' => $id
        ));
        $activities = $activity_details->row();        
        $this->db->where('id', $id)->delete('activity_plan');
        logEvent($user_id = NULL,"Deleted activity ID: {$id} for room ID: {$activities->room_id}",$care_id = NULL);
        flash('success', lang('Activity deleted'));
        redirectPrev(NULL, 'activities');
    }

    function copy()
    {
        allow(['admin', 'manager', 'staff']);
        $this->activity->copy();
        flash('success', lang('Activity plan copied to next week'));
        redirectPrev(NULL, 'activities');
    }

    function clear()
    {
        allow(['admin', 'manager', 'staff']);
        $this->activity->clear();
        logEvent($user_id = NULL, "Activities has been cleared",$care_id = NULL);
        flash('success', lang('Activity plan has been cleared'));
        redirectPrev(NULL, 'activities');
    }
}

?>