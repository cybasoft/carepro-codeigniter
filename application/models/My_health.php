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

    /***
     * @return bool
     */
    function addMedicationToChild()
    {
        $data = array(
            'child_id' => $this->input->post('child_id'),
            'med_name' => $this->input->post('med_name'),
            'med_notes' => $this->input->post('med_notes'),
            'photo_id' => $this->input->post('photo_id'),
            'created_at' => date_stamp(),
            'user_id' => $this->user->uid()
        );
        $this->db->insert('child_meds', $data);

        if($this->db->affected_rows()>0) {
            //log event
            logEvent("Added med for child ID: {$this->input->post('child_id')}");
            //notify parent
            $this->parent->notifyParents($data['child_id'], lang('new_medication_subject'), lang('new_medication_message'));
            return true;
        }
        return false;
    }

    /**
     * @param string $action
     * @return bool
     */
    function uploadMedPhoto($name)
    {
        $upload_path = APPPATH.'../assets/uploads/meds/';

        if(!file_exists($upload_path)) {
            mkdir($upload_path, 755, true);
        }

        $config = array(
            'upload_path' => $upload_path,
            'allowed_types' => 'png|jpg|jpeg|svg',
            'max_size' => '2048',
            'encrypt_name' => true,
            'overwrite' => true
        );

        $this->load->library('upload', $config);

        if(!$this->upload->do_upload('photo')) {

            $errors['errors'] = $this->upload->display_errors();
            flash('info', implode('', $errors));
            return false;

        } else {

            //upload new photo
            $upload_data = $this->upload->data();

            $data = array(
                'name'=>$name,
                'photo' => $upload_data['file_name']
            );
            $this->db->insert('med_photos',$data);

            if($this->db->affected_rows()>0)
                return true;
        }
        return false;
    }

    function medPhoto($photo_id){

        $med = $this->db->where('id',$photo_id)->get('med_photos')->row();

        if(count((array)$med)>0){
            return base_url('assets/uploads/meds/'.$med->photo);
        }else{
            return base_url('assets/img/content/pills.svg');
        }
    }

    function deleteMedicationPhoto($id){
        $med = $this->db->where('id',$id)->get('med_photos')->row();
        @unlink( APPPATH.'../assets/uploads/meds/'.$med->photo);

        $this->db->where('id',$id)->delete('med_photos');
        return true;
    }
    /**
     * @param $id
     * @return bool
     */
    function deleteMedication($id)
    {
        $this->db->where('id', $id)->delete('child_meds');

        if($this->db->affected_rows()>0)
            return true;
        return false;
    }

    /**
     * @return bool
     */
    function administerMed(){
        $date = $this->input->post('date').' '.$this->input->post('time');
        $this->db->insert('meds_admin',
            [
                'given_at'=>$date,
                'user_id'=>user_id(),
                'med_id'=> $this->input->post('med_id'),
                'child_id'=> $this->input->post('child_id'),
                'remarks'=> $this->input->post('remarks'),
                'staff_only'=> $this->input->post('staff_only') || 0,
                'created_at'=>date_stamp()
            ]
        );
        if($this->db->affected_rows()>0)
            return true;
        return false;
    }

    /**
     * @return bool
     */
    function addAllergy()
    {
        $data = array(
            'child_id' => $this->input->post('child_id'),
            'allergy' => $this->input->post('allergy'),
            'reaction' => $this->input->post('reaction'),
            'notes' => $this->input->post('notes'),
            'created_at' => date_stamp(),
            'user_id' => $this->user->uid()
        );

        $this->db->insert('child_allergy', $data);
        if($this->db->affected_rows()>0) {
            //log event
            logEvent("Added allergy for {$this->input->post('child_id')}");
            //notify parent
            $this->parent->notifyParents($data['child_id'], lang('new_allergy_subject'), lang('new_allergy_message'));
            return true;
        }
        return false;

    }

    /**
     * @return bool
     */
    function addProblem()
    {
        $data = array(
            'child_id' => $this->input->post('child_id'),
            'name' => $this->input->post('name'),
            'notes' => $this->input->post('notes'),
            'first_event' => $this->input->post('first_event'),
            'last_event' => $this->input->post('last_event'),
            'created_at' => date_stamp(),
            'user_id' => $this->user->uid()
        );
        $this->db->insert('child_problems', $data);
        if($this->db->affected_rows()>0) {
            //log event
            logEvent("Added problem for {$this->input->post('child_id')}");
            //notify parent
            $this->parent->notifyParents($data['child_id'], lang('new_problem_subject'), lang('new_problem_message'));
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
            'created_at' => date_stamp(),
            'user_id' => $this->user->uid()
        );
        if($this->db->insert('child_foodpref', $data)) {
            //log
            logEvent("Added food pref for child ID: {$this->input->post('child_id')}");
            //notify parent
            $this->parent->notifyParents($data['child_id'], lang('new_foodpref_subject'), lang('new_foodpref_message'));
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
            'created_at' => date_stamp(),
            'user_id' => $this->user->uid()
        );
        if($this->db->insert('child_contacts', $data)) {
            //log
            logEvent("Added contact for child ID: {$this->input->post('child_id')}");
            //notify parent
            $this->parent->notifyParents($data['child_id'], lang('new_contact_subject'), lang('new_contact_message'));
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
            'created_at' => date_stamp(),
            'user_id' => $this->user->uid()
        );
        if($this->db->insert('child_providers', $data)) {
            //log event
            logEvent("Added provider for child ID: {$this->input->post('child_id')}");
            //notify parent
            $this->parent->notifyParents($data['child_id'], lang('new_provider_subject'), lang('new_provider_message'));
            return true;
        }
        return false;
    }
}