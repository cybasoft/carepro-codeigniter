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
        $this->module = 'modules/calendar/';
    }

    /*
     * display main page
     */
    function index()
    {
        $this->title = lang('calendar');
        if (is('parent') && is('staff') == false) :
            page($this->module.'parent_view');
        else :
            page($this->module . 'index');
        endif;
    }

    function events()
    {
        $this->db->order_by('id');
        $query = $this->db->get('calendar')->result();
        // sending the encoded result to success page
        echo json_encode($query);
    }

    /*
     * add event to db
     */
    function addEvent()
    {
        allow('admin,manager,staff');

        $this->form_validation->set_rules('title', lang('title'), 'required|trim|xss_clean');
        $this->form_validation->set_rules('start', lang('start_date'), 'required|trim|xss_clean');
        $this->form_validation->set_rules('end', lang('end_date'), 'required|trim|xss_clean');
        $this->form_validation->set_rules('desc', lang('details'), 'required|trim|xss_clean');

        if ($this->form_validation->run() == TRUE) {
            $this->calendar->add_event();
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
        allow('admin,manager,staff');

        $this->form_validation->set_rules('title', lang('title'), 'required|trim|xss_clean');
        $this->form_validation->set_rules('start', lang('start_date'), 'required|trim|xss_clean');
        $this->form_validation->set_rules('end', lang('end_date'), 'required|trim|xss_clean');
        $this->form_validation->set_rules('desc', lang('details'), 'required|trim|xss_clean');

        if ($this->form_validation->run() == TRUE) {
            $this->calendar->update_event();
        } else {
            flash('danger', lang('request_error'));
        }
        redirectPrev();

    }

    /*
     * delete event
     */
    function deleteEvent()
    {
        allow('admin,manager,staff');
        if ($this->calendar->delete_event()) {
            flash('success', lang('request_success'));
        } else {
            flash('danger', lang('request_success'));
        }
    }
}