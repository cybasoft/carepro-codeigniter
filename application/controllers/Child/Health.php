<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Filename: ${FILE_NAME}
 * User: John Muchiri
 * Date: 11/10/2014
 */
class Health extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        //redirect session
        $this->conf->setRedirect();
        $this->conf->authenticate();
        $this->load->model('My_child', 'child');
        $this->load->model('My_health', 'health');
        $this->module = 'modules/child/health/';
    }

    function index($id)
    {
        $data['child'] = $this->child->first($id);
        $this->conf->page($this->module . 'index', $data);
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
            $this->conf->msg('danger', lang('request_error'));
        }
        $this->conf->redirectPrev();
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
            $this->conf->msg('success', lang('request_success'));
        } else {
            $this->conf->msg('danger', lang('request_error'));
        }
        //go back
        $this->conf->redirectPrev();
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
                $this->conf->msg('success', lang('request_success'));
            } else {
                $this->conf->msg('warning', lang('no_change_to_db'));
            }
        } else {
            $this->conf->msg('danger', lang('request_error'));
        }

        $this->conf->redirectPrev();
    }

    /*
     * delete allergy
     */
    function deleteAllergy($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('child_allergy');
        if ($this->db->affected_rows() > 0) {
            $this->conf->msg('success', lang('request_success'));
        } else {
            $this->conf->msg('danger', lang('request_error'));
        }
        $this->conf->redirectPrev();
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
                $this->conf->msg('success', lang('request_success'));
            }
        } else {
            $this->conf->msg('danger');
            validation_errors();
        }
        $this->conf->redirectPrev();

    }

    /*
     * delete food pref
     */
    function deleteFoodPref($id = "")
    {
        if ($id !== "" & is_numeric($id)) {
            //make sure its the parent authorized or admin
            if ($this->conf->isStaff() == true || $this->is_mychild()) {
                $this->db->where('id', $id);
                $this->db->delete('child_foodpref');
                if ($this->db->affected_rows() > 0) {
                    $this->conf->msg('success', lang('request_success'));
                } else {
                    $this->conf->msg('danger', lang('request_error'));
                }
            }

        }
        $this->conf->redirectPrev();
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
                $this->conf->msg('success', lang('request_success'));
            } else {
                $this->conf->msg('danger', lang('request_error'));
            }
        } else {
            $this->conf->msg('danger');
            validation_errors();
        }
        $this->conf->redirectPrev();
    }

    /**
     * @param $id
     */
    function deleteContact($id)
    {
        if ($this->db->where('id', $id)->delete('child_contacts')) {
            $this->conf->msg('success', lang('request_success'));
        } else {
            $this->conf->msg('danger', lang('request_danger'));
        }
        $this->conf->redirectPrev();
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
                $this->conf->msg('success', lang('request_success'));
            } else {
                $this->conf->msg('danger', lang('request_error'));
            }
        } else {
            $this->conf->msg('danger');
            validation_errors();
        }
        $this->conf->redirectPrev();
    }

    /**
     * @param $id
     */
    function deleteProvider($id)
    {
        if ($this->db->where('id', $id)->delete('child_providers')) {
            $this->conf->msg('success', lang('request_success'));
        } else {
            $this->conf->msg('danger', lang('request_danger'));
        }
        $this->conf->redirectPrev();
    }
}