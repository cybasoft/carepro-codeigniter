<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @file      : children.php
 * @author    : JMuchiri
 * @Copyright 2017 A&M Digital Technologies
 */
class Children extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        setRedirect();
        allow('admin,manager,staff,parent');
        $this->load->model('My_invoice', 'invoice');
        $this->module = 'modules/children/';
        $this->title = lang('children');
    }

    /*
     * default page
     * @return void
     */
    function index()
    {
        if(is('parent')) {
            $children = $this->parent->getChildren();
            page('modules/parent/index', compact('children'));
        } else {
            page($this->module.'index');
        }
    }

    /*
     * child registration form
     * @return void
     */

    function register()
    {
        page($this->module.'register');
    }

    function storeRoom()
    {
        allow('admin');
        $this->form_validation->set_rules('name', lang('name'), 'required|xss_clean|trim|is_unique[child_rooms.name]');
        $this->form_validation->set_rules('description', lang('description'), 'xss_clean|trim');
        if($this->form_validation->run() == true) {
            $this->db->insert('child_rooms',
                [
                    'name' => $this->input->post('name'),
                    'description' => $this->input->post('description'),
                    'created_at' => date_stamp()
                ]
            );
            if($this->db->affected_rows()>0) {
                flash('success', lang('Child room created! You can now assign children'));
            } else {
                flash('error', lang('request_error'));
            }
        } else {
            validation_errors();
            flash('error');
        }
        redirect('children#rooms');
    }

    function childrenToRoom()
    {
        allow('admin');
        $this->form_validation->set_rules('child_id[]', lang('children'), 'required|trim|xss_clean');
        $this->form_validation->set_rules('room_id', lang('room'), 'required|trim|xss_clean');
        if($this->form_validation->run() == true) {
            $this->db->where('room_id', $this->input->post('room_id'))->delete('child_room');
            foreach ($this->input->post('child_id') as $child) {
                $this->db->insert('child_room', [
                    'child_id' => $child,
                    'room_id' => $this->input->post('room_id'),
                    'created_at' => date_stamp()
                ]);
            }
            flash('success', lang('request_success'));
        } else {
            validation_errors();
            flash('error');
        }
        redirect('children?room='.$this->input->post('room_id').'#rooms');
    }

    function staffToRoom()
    {
        allow('admin');
        $this->form_validation->set_rules('user_id[]', lang('children'), 'required|trim|xss_clean');
        $this->form_validation->set_rules('room_id', lang('room'), 'required|trim|xss_clean');
        if($this->form_validation->run() == true) {
            $this->db->where('room_id', $this->input->post('room_id'))->delete('child_room_staff');
            foreach ($this->input->post('user_id') as $user) {
                $this->db->insert('child_room_staff', [
                    'user_id' => $user,
                    'room_id' => $this->input->post('room_id'),
                    'created_at'=>date_stamp()
                ]);
            }
            flash('success', lang('request_success'));
        } else {
            validation_errors();
            flash('error');
        }
        redirect('children?room='.$this->input->post('room_id').'#rooms');
    }
}