<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pickup extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        setRedirect();
        allow('admin,manager,staff,parent');
        $this->module = 'modules/child/';
        $this->title = lang('child').'-'.lang('pickup');
    }

    /*
     * add pickup contact
     */
    function store($id)
    {
        $this->form_validation->set_rules('first_name', lang('first_name'), 'required|trim|xss_clean');
        $this->form_validation->set_rules('last_name', lang('last_name'), 'required|trim|xss_clean');
        $this->form_validation->set_rules('cell', lang('cellphone'), 'required|xss_clean');
        $this->form_validation->set_rules('pin', lang('pin'), 'required|integer|trim|xss_clean');
        if ($this->form_validation->run() == TRUE) {
            $pickup = $this->child->createPickup($id);
            if ($pickup > 0) {
                
                flash('success', lang('request_success'));
                //upload photo
                $this->uploadPhoto($pickup);
            } else {
                flash('warning', lang('request_error'));
            }
        } else {
            flash('danger');
            validation_errors();
        }
        redirectPrev();
    }

    /*
     * delete child pickup profile
     */
    function deletePickup($id)
    {
        allow('admin,manager,staff');
        //delete images
        $upload_path = './assets/uploads/pickup';
        $this->db->where('id', $id);
        $q = $this->db->get('child_pickup');
        foreach ($q->result() as $r) {
            if ($r->photo !== "") :
                @unlink($upload_path . '/' . $r->photo);
            endif;
        }

        //delete entry
        $this->db->where('id', $id);
        if ($this->db->delete('child_pickup')) {
            flash('success', lang('request_success'));
        } else {
            flash('danger', lang('request_error'));
        }
        redirectPrev();
    }

    /**
     * @param string $id
     * @return bool
     */
    function uploadPhoto($id = "")
    {
        $upload_path = APPPATH.'../assets/uploads/pickup/';
        $upload_db = 'child_pickup';

        if (!is_dir($upload_path)) {
            mkdir($upload_path, 755, true);
        }

        $config = array(
            'upload_path' => $upload_path,
            'allowed_types' => 'jpg|png|jpeg|svg',
            //'max_size'      => '100',
            'max_width' => '1240',
            'max_height' => '1240',
            'encrypt_name' => true,
        );
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('photo')) {
             flash('error', $this->upload->display_errors());
            return false;
        } else {
            //delete if any exists
            $this->db->where('id', $id);
            $q = $this->db->get($upload_db);
            foreach ($q->result() as $r) {
                if ($r->photo !== "") :
                    @unlink($upload_path . '/' . $r->photo);
                    $data['photo'] = '';
                    $this->db->where('id', $id);
                    $this->db->update($upload_db, $data);
                endif;
            }
            //upload new photo
            $upload_data = $this->upload->data();
            $data_ary = array(
                'photo' => $upload_data['file_name']
            );
            $this->db->where('id', $id);
            $this->db->update($upload_db, $data_ary);
            $data = array('upload_data' => $upload_data);
            if ($data) {
                return true;
            } else {
                flash('error','Error');
                return false;
            }
        }

        return  true;
    }
}