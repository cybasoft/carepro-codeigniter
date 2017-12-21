<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Health extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        //redirect session
        setRedirect();
        auth();
        $this->load->model('My_child', 'child');
        $this->load->model('My_health', 'health');
        $this->module = 'modules/child/health/';
    }

    function index($id)
    {
        $data['child'] = $this->child->first($id);
        if(empty($data['child'])){
            flash('error',lang('request_error'));
            redirect('/dashboard');
        }
        page($this->module . 'index', $data);
    }

    /*
     * add medication
     * @return void
     */
    function addMedication()
    {
        $this->form_validation->set_rules('med_name', lang('medication'), 'required|trim|xss_clean');
        if ($this->form_validation->run() == TRUE) {
            $this->health->addMedication();
        } else {
            flash('danger', lang('request_error'));
        }
        redirectPrev();
    }

    /*
     * delete medication
     * @return void
     */
    function deleteMedication($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('child_meds');
        if ($this->db->affected_rows() > 0) {
            flash('success', lang('request_success'));
        } else {
            flash('danger', lang('request_error'));
        }
        //go back
        redirectPrev();
    }

    /*
     * add allergy
     * @return void
     */
    function addAllergy()
    {
        $this->form_validation->set_rules('allergy', 'Allergy Name', 'required|trim|xss_clean');
        if ($this->form_validation->run() == TRUE) {
            if ($this->health->addAllergy()) {
                flash('success', lang('request_success'));
            } else {
                flash('warning', lang('no_change_to_db'));
            }
        } else {
            flash('danger', lang('request_error'));
        }

        redirectPrev();
    }

    /*
     * delete allergy
     */
    function deleteAllergy($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('child_allergy');
        if ($this->db->affected_rows() > 0) {
            flash('success', lang('request_success'));
        } else {
            flash('danger', lang('request_error'));
        }
        redirectPrev();
    }


    /*
     * add food pref
     */
    function addFoodPref()
    {
        $this->form_validation->set_rules('food', lang('food'), 'required|trim|xss_clean');
        $this->form_validation->set_rules('food_time', lang('time'), 'required|trim|xss_clean');
        $this->form_validation->set_rules('comment', lang('comment'), 'trim|xss_clean');

        if ($this->form_validation->run() == TRUE) {

            if ($this->health->addFoodPref()) {
                flash('success', lang('request_success'));
            }
        } else {
            flash('danger');
            validation_errors();
        }
        redirectPrev();

    }

    /*
     * delete food pref
     */
    function deleteFoodPref($id = "")
    {
        if ($id !== "" & is_numeric($id)) {
            //make sure its the parent authorized or admin
            if (is('staff') == true || $this->is_mychild()) {
                $this->db->where('id', $id);
                $this->db->delete('child_foodpref');
                if ($this->db->affected_rows() > 0) {
                    flash('success', lang('request_success'));
                } else {
                    flash('danger', lang('request_error'));
                }
            }

        }
        redirectPrev();
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
        if ($this->form_validation->run() == TRUE) {
            if ($this->health->addContact()) {
                flash('success', lang('request_success'));
            } else {
                flash('danger', lang('request_error'));
            }
        } else {
            flash('danger');
            validation_errors();
        }
        redirectPrev();
    }

    /**
     * @param $id
     */
    function deleteContact($id)
    {
        if ($this->db->where('id', $id)->delete('child_contacts')) {
            flash('success', lang('request_success'));
        } else {
            flash('danger', lang('request_danger'));
        }
        redirectPrev();
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
        if ($this->form_validation->run() == TRUE) {
            if ($this->health->addProvider()) {
                flash('success', lang('request_success'));
            } else {
                flash('danger', lang('request_error'));
            }
        } else {
            flash('danger');
            validation_errors();
        }
        redirectPrev();
    }

    /**
     * @param $id
     */
    function deleteProvider($id)
    {
        if ($this->db->where('id', $id)->delete('child_providers')) {
            flash('success', lang('request_success'));
        } else {
            flash('danger', lang('request_danger'));
        }
        redirectPrev();
    }
}