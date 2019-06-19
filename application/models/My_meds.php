<?php

class My_meds extends CI_Model
{

    function medPhoto($photo_id)
    {

        $med = $this->db->where('id', $photo_id)->get('med_photos')->row();

        if(count((array)$med) > 0) {
            return base_url('assets/uploads/meds/'.$med->photo);
        } else {
            return base_url('assets/img/content/pills.svg');
        }
    }

    /***
     * @return bool
     */
    function addMedicationToChild()
    {
        $data = [
            'child_id' => $this->input->post('child_id'),
            'med_name' => $this->input->post('med_name'),
            'med_notes' => $this->input->post('med_notes'),
            'photo_id' => $this->input->post('photo_id'),
            'created_at' => date_stamp(),
            'user_id' => $this->user->uid(),
        ];
        $this->db->insert('child_meds', $data);
        $last_id = $this->db->insert_id();

        if($this->db->affected_rows() > 0) {
            //log event
            logEvent($id = NULL,"Added med ID: {$last_id} for child ID: {$this->input->post('child_id')}");
            //notify parent
            $this->parent->notifyParents($data['child_id'], lang('new_medication_subject'), lang('new_medication_message').' <p><strong>'.$this->input->post('med_name').'</strong></p>');
            return TRUE;
        }
        return FALSE;
    }

    /**
     * @param string $action
     *
     * @return bool
     */
    function uploadMedPhoto($name)
    {
        $upload_path = APPPATH.'../assets/uploads/meds/';

        if(!file_exists($upload_path)) {
            mkdir($upload_path, 0777, TRUE);
            chmod($upload_path, 0777);
        }
        $config = [
            'upload_path' => $upload_path,
            'allowed_types' => 'png|jpg|jpeg|svg',
            'max_size' => '2048',
            'encrypt_name' => TRUE,
            'overwrite' => TRUE,
        ];

        $this->load->library('upload', $config);

        if(!$this->upload->do_upload('photo')) {

            $errors['errors'] = $this->upload->display_errors();
            flash('info', implode('', $errors));
            return FALSE;

        } else {

            //upload new photo
            $upload_data = $this->upload->data();

            $data = [
                'name' => $name,
                'photo' => $upload_data['file_name'],
            ];
            $this->db->insert('med_photos', $data);

            if($this->db->affected_rows() > 0)
                logEvent($user_id = NULL,"Medication Image is added for child");
                return TRUE;
        }
        return FALSE;
    }


    function deleteMedicationPhoto($id)
    {
        $med = $this->db->where('id', $id)->get('med_photos')->row();
        @unlink(APPPATH.'../assets/uploads/meds/'.$med->photo);

        $this->db->where('id', $id)->delete('med_photos');
        return TRUE;
    }

    /**
     * @param $id
     *
     * @return bool
     */
    function deleteMedication($id)
    {
        $this->db->where('id', $id)->delete('child_meds');

        if($this->db->affected_rows() > 0)
            return TRUE;
        return FALSE;
    }

    /**
     * @return bool
     */
    function administerMed()
    {
        $date = $this->input->post('date').' '.$this->input->post('time');
        $this->db->insert('meds_admin',
            [
                'given_at' => $date,
                'user_id' => user_id(),
                'med_id' => $this->input->post('med_id'),
                'child_id' => $this->input->post('child_id'),
                'remarks' => $this->input->post('remarks'),
                'staff_only' => $this->input->post('staff_only') || 0,
                'created_at' => date_stamp(),
            ]
        );
        if($this->db->affected_rows() > 0)
            return TRUE;
        return FALSE;
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    function history($id)
    {
        if(is('parent'))
            $this->db->where('m.staff_only !=', 1);
        $this->db->where('m.med_id', $id);
        $this->db->select("m.*, CONCAT(u.first_name,' ',u.last_name) AS name");
        $this->db->from('meds_admin as m');
        $this->db->join('users as u', 'u.id=m.user_id');
        $results = $this->db->get('meds_admin')->result();
        return $results;
    }

    function deleteHistory($id)
    {
        $this->db->where('id', $id)->delete('meds_admin');
        if($this->db->affected_rows() > 0)
            return TRUE;
        return FALSE;
    }
}