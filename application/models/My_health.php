<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class: my_health
 * User: John Muchiri
 * Email: jgmuchiri@gmail.com
 * Date: 11/29/2014
 *
 * https://amdtllc.com
 * Copyright 2014 All Rights Reserved
 */
class my_health extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }


    function addMedication()
    {
        $data = array(
            'child_id' => $this->input->post('child_id'),
            'med_name' => $this->input->post('med_name'),
            'med_notes' => $this->input->post('med_notes')
        );
        $this->db->insert('child_meds', $data);
        if ($this->db->affected_rows() > 0) {
            //log event
            $this->conf->log("Added med for child ID: {$this->input->post('child_id')}");


            $this->conf->msg('success', lang('request_success'));
        } else {
            $this->conf->msg('warning', lang('no_change_to_db'));
        }
    }

    function addAllergy()
    {
        $data = array(
            'child_id' => $this->input->post('child_id'),
            'allergy' => $this->input->post('allergy'),
            'reaction' => $this->input->post('reaction'),
        );
        $this->db->insert('child_allergy', $data);
        if ($this->db->affected_rows() > 0) {
            //log event
            $this->conf->log("Added allergy for {$this->input->post('child_id')}");
            return true;
        }
        return false;

    }

    /**
     * @return bool
     */
    function addFoodPref()
    {
        $data = array(
            'child_id' => $this->input->post('child_id'),
            'food' => $this->input->post('food'),
            'food_time' => $this->input->post('food_time'),
            'comment' => $this->input->post('comment')
        );
        if ($this->db->insert('child_foodpref', $data)) {
            $this->conf->log("Added food pref for child ID: {$this->input->post('child_id')}");
            return true;
        }
        return false;
    }

    /**
     * @return bool
     */
    function addContact()
    {
        $data = array(
            'child_id' => $this->input->post('child_id'),
            'contact_name' => $this->input->post('name'),
            'relation' => $this->input->post('relation'),
            'phone' => $this->input->post('phone'),
            'address' => $this->input->post('address')
        );
        if ($this->db->insert('child_contacts', $data)) {
            //log event
            $this->conf->log("Added contact for child ID: {$this->input->post('child_id')}");
            return true;
        }
        return false;
    }

    /**
     * @return bool
     */
    function addProvider()
    {
        $data = array(
            'child_id' => $this->input->post('child_id'),
            'provider_name' => $this->input->post('name'),
            'type_role' => $this->input->post('type_role'),
            'phone' => $this->input->post('phone'),
            'address' => $this->input->post('address'),
            'notes' => $this->input->post('notes')
        );
        if ($this->db->insert('child_providers', $data)) {
            //log event
            $this->conf->log("Added provider for child ID: {$this->input->post('child_id')}");
            return true;
        }
        return false;
    }
}