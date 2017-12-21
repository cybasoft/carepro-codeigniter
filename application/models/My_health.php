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
            'med_notes' => $this->input->post('med_notes'),
            'created_at'=>date_stamp(),
            'user_id'=>$this->user->uid()
        );
        $this->db->insert('child_meds', $data);
        if ($this->db->affected_rows() > 0) {
            //log event
            logEvent("Added med for child ID: {$this->input->post('child_id')}");


            flash('success', lang('request_success'));
        } else {
            flash('warning', lang('no_change_to_db'));
        }
    }

    function addAllergy()
    {
        $data = array(
            'child_id' => $this->input->post('child_id'),
            'allergy' => $this->input->post('allergy'),
            'reaction' => $this->input->post('reaction'),
            'created_at'=>date_stamp(),
            'user_id'=>$this->user->uid()
        );
        $this->db->insert('child_allergy', $data);
        if ($this->db->affected_rows() > 0) {
            //log event
            logEvent("Added allergy for {$this->input->post('child_id')}");
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
            'comment' => $this->input->post('comment'),
            'created_at'=>date_stamp(),
            'user_id'=>$this->user->uid()
        );
        if ($this->db->insert('child_foodpref', $data)) {
            logEvent("Added food pref for child ID: {$this->input->post('child_id')}");
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
            'address' => $this->input->post('address'),
            'created_at'=>date_stamp(),
            'user_id'=>$this->user->uid()
        );
        if ($this->db->insert('child_contacts', $data)) {
            //log event
            logEvent("Added contact for child ID: {$this->input->post('child_id')}");
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
            'notes' => $this->input->post('notes'),
            'created_at'=>date_stamp(),
            'user_id'=>$this->user->uid()
        );
        if ($this->db->insert('child_providers', $data)) {
            //log event
            logEvent("Added provider for child ID: {$this->input->post('child_id')}");
            return true;
        }
        return false;
    }
}