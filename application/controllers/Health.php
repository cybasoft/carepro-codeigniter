<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Health extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        //redirect session
        setRedirect();
        auth(true);
        $this->load->model('My_child', 'child');
        $this->load->model('My_health', 'health');
        $this->load->model('My_food', 'food');
        $this->module = 'modules/child/health/';
        $this->title = lang('child').'-'.lang('health');
    }

    function index($id)
    {
        if(!authorizedToChild($this->user->uid(), $id)) {
            flash('error', lang('You do not have permission to view this child\'s profile'));
            redirectPrev();
        }

        $data['child'] = $this->child->first($id);
        if(empty($data['child'])) {
            flash('error', lang('request_error'));
            redirect('/dashboard');
        }
        page($this->module.'index', $data);
    }

    /*
     * add allergy
     * @return void
     */
    function addAllergy()
    {
        allow(['admin','manager','staff']);

        $this->form_validation->set_rules('allergy', 'Allergy Name', 'required|trim|xss_clean');

        if($this->form_validation->run() == TRUE) {

            if($this->health->addAllergy()) {

                flash('success', lang('request_success'));

            } else {

                flash('warning', lang('no_change_to_db'));

            }

        } else {

            flash('danger', lang('request_error'));

        }

        redirectPrev(null, 'allergies');
    }

    /*
     * delete allergy
     */
    function deleteAllergy($id)
    {
        allow(['admin','manager','staff']);
        $this->db->where('id', $id);
        $this->db->delete('child_allergy');
        if($this->db->affected_rows() > 0) {
            flash('success', lang('request_success'));
        } else {
            flash('danger', lang('request_error'));
        }
        redirectPrev(null, 'allergies');
    }

    /**
     * add contact
     */
    function addContact()
    {
        $this->form_validation->set_rules('name', lang('name'), 'required|trim|xss_clean');
        $this->form_validation->set_rules('phone', lang('phone'), 'required|trim|xss_clean');
        $this->form_validation->set_rules('relation', lang('relation'), 'required|trim|xss_clean');
        $this->form_validation->set_rules('address', lang('address'), 'trim|xss_clean');
        if($this->form_validation->run() == TRUE) {
            if($this->health->addContact()) {
                flash('success', lang('request_success'));
            } else {
                flash('danger', lang('request_error'));
            }
        } else {
            flash('danger');
            validation_errors();
        }
        redirectPrev(null, 'emergency_contacts');
    }

    /**
     * @param $id
     */
    function deleteContact($id)
    {
        allow(['admin','manager','staff']);
        if($this->db->where('id', $id)->delete('child_contacts')) {
            flash('success', lang('request_success'));
        } else {
            flash('danger', lang('request_danger'));
        }
        redirectPrev(null, 'contacts');
    }


    /**
     * add contact
     */
    function addProvider()
    {
        $this->form_validation->set_rules('name', lang('name'), 'required|trim|xss_clean');
        $this->form_validation->set_rules('phone', lang('phone'), 'required|trim|xss_clean');
        $this->form_validation->set_rules('type_role', lang('type_role'), 'required|trim|xss_clean');
        $this->form_validation->set_rules('address', lang('address'), 'trim|xss_clean');
        $this->form_validation->set_rules('notes', lang('address'), 'trim|xss_clean');
        if($this->form_validation->run() == TRUE) {
            if($this->health->addProvider()) {
                flash('success', lang('request_success'));
            } else {
                flash('danger', lang('request_error'));
            }
        } else {
            flash('danger');
            validation_errors();
        }
        redirectPrev(null, 'providers');
    }

    /**
     * @param $id
     */
    function deleteProvider($id)
    {
        allow(['admin','manager','staff']);
        if($this->db->where('id', $id)->delete('child_providers')) {
            flash('success', lang('request_success'));
        } else {
            flash('danger', lang('request_danger'));
        }
        redirectPrev(null, 'providers');
    }


    /*
     * add allergy
     * @return void
     */
    function addProblem()
    {
        allow(['admin','manager','staff']);

        $this->form_validation->set_rules('name', lang('problem'), 'required|trim|xss_clean');
        $this->form_validation->set_rules('first_event', lang('problem'), 'required|trim|xss_clean');
        $this->form_validation->set_rules('last_event', lang('problem'), 'trim|xss_clean');
        $this->form_validation->set_rules('notes', lang('problem'), 'trim|xss_clean');
        if($this->form_validation->run() == TRUE) {
            if($this->health->addProblem()) {
                flash('success', lang('request_success'));
            } else {
                flash('warning', lang('request_error'));
            }
        } else {
            flash('danger', lang('request_error'));
        }

        redirectPrev(null, 'problem-list');
    }

    /**
     * @param $id
     */
    function deleteProblem($id)
    {
        allow(['admin','manager','staff']);
        if($this->db->where('id', $id)->delete('child_problems')) {
            flash('success', lang('request_success'));
        } else {
            flash('danger', lang('request_danger'));
        }
        redirectPrev(null, 'problem-list');
    }
}