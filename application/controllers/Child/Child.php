<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @file      : child.php
 * @author    : JMuchiri
 * @Copyright 2017 A&M Digital Technologies
 */
class Child extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->conf->setRedirect();
        $this->conf->allow('admin,manager,staff');
        $this->load->model('My_invoice', 'invoice');
        $this->module = 'modules/child/';
    }

    /*
     * default page
     * @return void
     */
    function index($id)
    {
        $this->session->set_userdata('view_child_id', $id);
        $data['child'] = $this->child->child($id);
        $data['page']=$this->module.'dashboard';
        $this->conf->page($this->module . 'index',$data);
    }

    /*
     * validate and update child information
     * @params int $id
     * @return void
     */

    function update()
    {
        $this->form_validation->set_rules('fname', lang('first_name'), 'required|trim|xss_clean');
        $this->form_validation->set_rules('lname', lang('last_name'), 'required|trim|xss_clean');
        $this->form_validation->set_rules('ssn', lang('social_security'), 'trim|xss_clean');
        $this->form_validation->set_rules('bday', lang('birthday'), 'required|trim|xss_clean');
        $this->form_validation->set_rules('blood_type', lang('birthday'), 'required|trim|xss_clean');
        $this->form_validation->set_rules('gender', lang('gender'), 'required|trim|xss_clean');
        $this->form_validation->set_rules('child_status', lang('status'), 'required|trim|xss_clean');
        if ($this->form_validation->run() == TRUE) {
            $this->child->update_child($this->input->post('child_id'));
        } else {
            $this->conf->msg('danger', lang('request_error'));
        }
        redirect('child/' . $this->input->post('child_id'), 'refresh');
    }

    /*
     * deleting is currently disable. Only sets record as inactive
     * @return void
     */
    function deleteChild($id)
    {
        $this->conf->allow('admin');

        $this->db->where('id', $id);
        if ($this->db->update('children', array('status', 0))) {
            $this->conf->msg('success', lang('request_success'));
        } else {
            $this->conf->msg('danger', lang('request_error'));
        }
        redirect('children', 'refresh');
    }

    /*
     * upload photos to specific db
     * @param $id int
     * @param $db string
     */

    function uploadPhoto($id = "")
    {
        if (!$this->conf->isStaff()) $this->conf->redirectPrev();

        $upload_path = './assets/img/users/children';
        $upload_db = 'children';

        if (!file_exists($upload_path)) {
            mkdir($upload_path, 755, true);
        }

        if ($id == "") { //make sure there are arguments
            $this->conf->msg('danger', lang('request_error'));
            $this->conf->redirectPrev();
        }

        $config = array(
            'upload_path' => $upload_path,
            'allowed_types' => 'gif|jpg|png|jpeg',
            //'max_size'      => '100',
            'max_width' => '1240',
            'max_height' => '1240',
            'encrypt_name' => true,
        );
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload()) {
            $this->conf->msg('danger', lang('request_error'));
        } else {
            //delete if any exists
            $this->db->where('id', $id);
            $q = $this->db->get($upload_db);
            foreach ($q->result() as $r) {
                if ($r->photo !== "") :
                    unlink($upload_path . '/' . $r->photo);
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
                $this->conf->msg('success', lang('request_success'));
            } else {
                $this->conf->msg('danger', lang('request_error'));
            }
        }

        $this->conf->redirectPrev();
    }

    ////////////NOTES/////////////////
    function notes()
    {
        $this->conf->page($this->module . 'notes');
    }

    ///////////PICKUP CONTACT/////////
    function pickup()
    {
        $this->conf->page($this->module . 'pickup');
    }

    /////////INVOICE/////////////////
    function invoice($status = "")
    {
        $data['status'] = $status;
        $this->conf->page($this->module . 'accounting/index', $data);
    }

    /////////EMERGENCY CONTACT/////////
    function emergency()
    {
        $data['eContact'] = $this->db->where('child_id', $this->child->getID())->get('child_emergency');
        $this->conf->page($this->module . 'emergency', $data);
    }

    /////////REPORTS//////////////////
    function reports()
    {
        $cid = $this->child->getID();
        $data['attendance'] = $this->db->where('child_id', $cid)->order_by('id', 'DESC')->get('child_checkin');
        $this->conf->page($this->module . 'reports/attendance', $data);
    }


    //check this user and parent association
    function is_mychild()
    {
        $this->db->where('child_id', $this->child->getID());
        $this->db->where('user_id', $this->users->uid());
        $query = $this->db->get('child_users');
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    /*
     * check_in
     */
    function check_in($id)
    {
        $data = array(
            'child_id' => $id,
            'parents' => $this->child->getParents($id)->result()
        );
        $this->load->view($this->module . 'check_in', $data);
    }

    /*
     * check_out
     */
    function check_out($id)
    {
        $data = array(
            'child_id' => $id,
            'parents' => $this->child->getParents($id)->result()
        );
        $this->load->view($this->module . 'check_out', $data);
    }

    /*
     * check in
     */
    function checkIn($child_id)
    {
        $this->form_validation->set_rules('pin', lang('pin'), 'required|trim|xss_clean');
        if ($this->form_validation->run() == true) {
            $parent = $this->input->post('parent_id');
            $pin = $this->input->post('pin');
            $this->child->check_in($child_id, $parent, $pin);
        } else {
            validation_errors();
            $this->conf->msg('danger');
        }
        $this->conf->redirectPrev();
    }

    /*
     * check out
     */
    function checkOut($child_id)
    {
        $this->form_validation->set_rules('pin', lang('pin'), 'required|trim|xss_clean');
        if ($this->form_validation->run() == true) {
            $parent = $this->input->post('parent_id');
            $pin = $this->input->post('pin');
            $this->child->check_out($child_id, $parent, $pin);
        } else {
            validation_errors();
            $this->conf->msg('danger');
        }
        $this->conf->redirectPrev();
    }

    /*
     * assign parent
     */
    function assignParent($child_id)
    {
        $this->load->view($this->module . 'assign_parent', compact('child_id'));
    }

    function doAssignParent($child_id)
    {
        $this->form_validation->set_rules('parent', lang('parent'), 'required|trim|xss_clean|callback_user_not_assigned');
        if ($this->form_validation->run() == TRUE) {
            $data = array(
                'user_id' => $this->input->post('parent'),
                'child_id' => $child_id
            );
            if ($this->db->insert('child_users', $data)) {
                $this->conf->msg('success', lang('request_success'));
            }
        } else {
            $this->conf->msg('danger');
            validation_errors();
        }
        $this->conf->redirectPrev();
    }

    /*
     * user_not_assigned
     * ensure user has not already been assigned
     */
    function user_not_assigned()
    {
        $user_id = $this->input->post('parent');
        $child_id = $this->input->post('child');
        $this->db->where('user_id', $user_id);
        $this->db->where('child_id', $child_id);
        $query = $this->db->get('child_users');
        if ($query->num_rows() > 0) {
            $this->form_validation->set_message('user_not_assigned', lang('user_already_assigned'));
            $this->conf->msg('danger', lang('request_error'));
            return false;
        } else {
            return true;
        }
    }

    /*
     * removeParent
     */
    function removeParent($id)
    {
        if ($this->db->where('id', $id)->delete('child_users')) {
            $this->conf->msg('success', lang('request_success'));
        } else {
            $this->conf->msg('danger', lang('request_error'));
        }
        $this->conf->redirectPrev();
    }

}