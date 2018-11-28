<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

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

    /**
     * @return bool
     */
    function addAllergy()
    {
        $data = [
            'child_id' => $this->input->post('child_id'),
            'allergy' => $this->input->post('allergy'),
            'reaction' => $this->input->post('reaction'),
            'notes' => $this->input->post('notes'),
            'created_at' => date_stamp(),
            'user_id' => $this->user->uid(),
        ];

        $this->db->insert('child_allergy', $data);
        if($this->db->affected_rows() > 0) {
            //log event
            logEvent("Added allergy for {$this->input->post('child_id')}");
            //notify parent
            $this->parent->notifyParents($data['child_id'], lang('new_allergy_subject'), lang('new_allergy_message'));
            return TRUE;
        }
        return FALSE;

    }

    /**
     * @return bool
     */
    function addProblem()
    {
        $data = [
            'child_id' => $this->input->post('child_id'),
            'name' => $this->input->post('name'),
            'notes' => $this->input->post('notes'),
            'first_event' => $this->input->post('first_event'),
            'last_event' => $this->input->post('last_event'),
            'created_at' => date_stamp(),
            'user_id' => $this->user->uid(),
        ];
        $this->db->insert('child_problems', $data);
        if($this->db->affected_rows() > 0) {
            //log event
            logEvent("Added problem for {$this->input->post('child_id')}");
            //notify parent
            $this->parent->notifyParents($data['child_id'], lang('new_problem_subject'), lang('new_problem_message'));
            return TRUE;
        }
        return FALSE;

    }


    /**
     * @return bool
     */
    function addContact()
    {
        $data = [
            'child_id' => $this->input->post('child_id'),
            'contact_name' => $this->input->post('name'),
            'relation' => $this->input->post('relation'),
            'phone' => $this->input->post('phone'),
            'address' => $this->input->post('address'),
            'created_at' => date_stamp(),
            'user_id' => $this->user->uid(),
        ];
        if($this->db->insert('child_contacts', $data)) {
            //log
            logEvent("Added contact for child ID: {$this->input->post('child_id')}");
            //notify parent
            $this->parent->notifyParents($data['child_id'], lang('new_contact_subject'), lang('new_contact_message'));
            return TRUE;
        }
        return FALSE;
    }

    /**
     * @return bool
     */
    function addProvider()
    {
        $data = [
            'child_id' => $this->input->post('child_id'),
            'provider_name' => $this->input->post('name'),
            'type_role' => $this->input->post('type_role'),
            'phone' => $this->input->post('phone'),
            'address' => $this->input->post('address'),
            'notes' => $this->input->post('notes'),
            'created_at' => date_stamp(),
            'user_id' => $this->user->uid(),
        ];
        if($this->db->insert('child_providers', $data)) {
            //log event
            logEvent("Added provider for child ID: {$this->input->post('child_id')}");
            //notify parent
            $this->parent->notifyParents($data['child_id'], lang('new_provider_subject'), lang('new_provider_message'));
            return TRUE;
        }
        return FALSE;
    }
}