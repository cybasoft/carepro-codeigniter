<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @file      : Calendar
 * @author    : JMuchiri
 * @Copyright 2017 A&M Digital Technologies
 * https://amdtllc.com
 */
class Calendar extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        //redirect session
        setRedirect();
        auth(true);
        //local resources (models,libraries etc)
        $this->load->model('My_calendar', 'calendar');

        //local variables
        $this->module = 'calendar/';
    }

    /*
     * display main page
     */
    function index()
    {
        $daycare_id = $this->session->userdata('owner_daycare_id');
        $this->title = lang('calendar');
        if (is('parent')) :
            dashboard_page('parent/calendar',$data = [], $daycare_id);
        else :
            dashboard_page($this->module . 'index',$data = [], $daycare_id);
        endif;
    }

    function events()
    {
        $this->db->order_by('id');
        $active_user = $this->user->uid();
        $daycare_id = $this->session->userdata('daycare_id');
        if(!is('staff')){
            $query = $this->db
            ->select('*,start as start_date,end as end_date')
            ->where('daycare_id',$daycare_id)
            ->get('calendar')->result();
        }else{
            $query = $this->db
            ->select('*,start as start_date,end as end_date')
            ->where([
                'daycare_id' => $daycare_id,
                'user_id' => user_id()
             ])
            ->get('calendar')->result();
        }     
        // sending the encoded result to success page
        echo json_encode($query);
    }

    /*
     * add event to db
     */
    function addEvent()
    {
        allow(['admin','manager','staff']);

        $this->form_validation->set_rules('title', lang('title'), 'required|trim|xss_clean');
        $this->form_validation->set_rules('start', lang('start_date'), 'required|trim|xss_clean');
        $this->form_validation->set_rules('end', lang('end_date'), 'required|trim|xss_clean');
        $this->form_validation->set_rules('desc', lang('details'), 'required|trim|xss_clean');

        if ($this->form_validation->run() == TRUE) {
            $calender = $this->calendar->add_event();
            if($calender == "error"){
                flash('danger', sprintf(lang('upgrade_plan'),'Calender Events'));
                redirect('calendar');
            }
        } else {
            validation_errors();
            flash('danger');
        }
        redirectPrev();
    }

    /*
     * update event
     */
    function updateEvent()
    {
        allow(['admin','manager','staff']);

        $this->form_validation->set_rules('title', lang('title'), 'required|trim|xss_clean');
        $this->form_validation->set_rules('start', lang('start_date'), 'required|trim|xss_clean');
        $this->form_validation->set_rules('end', lang('end_date'), 'required|trim|xss_clean');
        $this->form_validation->set_rules('desc', lang('details'), 'required|trim|xss_clean');

        if ($this->form_validation->run() == TRUE) {
            $this->calendar->update_event();
        } else {
			flash('danger');
        }
        redirectPrev();

    }

    /*
     * delete event
     */
    function deleteEvent()
    {
        allow(['admin','manager','staff']);
        if ($this->calendar->delete_event()) {
            flash('success', lang('request_success'));
        } else {
            flash('danger', lang('request_success'));
        }
    }
}