<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @file: ${FILE_NAME}
 * @author: John Muchiri.
 * @date: 2014
 * @Copyright: 2014 iCoolPix Designs
 */
class Users extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->conf->setRedirect();
        $this->conf->allow('admin,manager,staff');
        $this->module = 'modules/users/';
    }
    //redirect if needed, otherwise display the user list
    function index()
    {
        //set the flash data error message if there is one
        $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
        //list the users
        $this->data['users'] = $this->ion_auth->users()->result();
        foreach ($this->data['users'] as $k => $user) {
            $this->data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
        }
        $this->data['groups'] = $this->db->get('groups')->result();

        $this->conf->page($this->module . 'index', $this->data);
    }

    //activate the user
    function activate($id, $code = false)
    {
        $this->conf->allow('admin');

        if ($code !== false) {
            $activation = $this->ion_auth->activate($id, $code);
        } else {
            $activation = $this->ion_auth->activate($id);
        }
        if ($activation) {
            //redirect them to the auth page
            $this->conf->msg('success', lang('user_activated'));
        } else {
            //redirect them to the forgot password page
            $this->conf->msg('danger', lang('request_error'));
        }
        redirect("users", 'refresh');
    }

    //deactivate the user
    function deactivate($id = NULL)
    {
        $this->conf->allow('admin');
        $id = (int)$id;

        $this->load->library('form_validation');
        $this->form_validation->set_rules('confirm', $this->lang->line('deactivate_validation_confirm_label'), 'required');
        $this->form_validation->set_rules('id', $this->lang->line('deactivate_validation_user_id_label'), 'required|alpha_numeric');

        if ($this->form_validation->run() == FALSE) {

            $data['user_id'] = $id;
            $this->conf->page($this->module . 'deactivate_user', $data);
        } else {
            if ($this->input->post('confirm') == 'yes') {
                $this->ion_auth->deactivate($id);
                $this->conf->msg('warning', lang('user_deactivated'));
            } else {
                $this->conf->msg('info', lang('action_cancelled'));
            }
            redirect("users", 'refresh');
        }
    }

    //create a new user
    function create_user()
    {
        $tables = $this->config->item('tables', 'ion_auth');

        //validate form input
        $this->form_validation->set_rules('username', lang('username'), 'required|xss_clean');
        $this->form_validation->set_rules('first_name', lang('first_name'), 'required|xss_clean|min_length[2]');
        $this->form_validation->set_rules('last_name', lang('last_name'), 'required|xss_clean|min_length[2]');
        $this->form_validation->set_rules('email', lang('email'), 'required|valid_email|is_unique[' . $tables['users'] . '.email]');
        $this->form_validation->set_rules('phone', lang('phone'), 'required|xss_clean');
        $this->form_validation->set_rules('password', lang('password'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
        $this->form_validation->set_rules('password_confirm', lang('password_confirm'), 'required');

        if ($this->form_validation->run() == true) {
            $username = strtolower($this->input->post('username'));
            $email = strtolower($this->input->post('email'));
            $password = $this->input->post('password');

            $additional_data = array(
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'phone' => $this->input->post('phone'),
            );

            if ($this->ion_auth->register($username, $password, $email, $additional_data)) {
                $this->conf->msg('success', lang('request_success'));
            }

        } else {
            $this->conf->msg('danger', lang('request_error'));
        }
        redirect('users', 'refresh');
    }

    function edit($id)
    {
        $this->conf->allow('admin,manager');

        $this->user->checkData($id); //create empty fields for user data in db
        //user vars
        $user = $this->ion_auth->user($id)->row();
        $userData = $this->db->query('SELECT * FROM user_data WHERE user_id=' . $id)->row();
        $groups = $this->ion_auth->groups()->result_array();
        $currentGroups = $this->ion_auth->get_users_groups($id)->result();

        //pass the user to the view
        $myData = array(
            'user' => $user,
            'userData' => $userData,
            'groups' => $groups,
            'currentGroups' => $currentGroups
        );

        $this->conf->page($this->module . 'edit_user', $myData);
    }

    //edit a user
    function update_user()
    {
        $this->conf->allow('admin,manager');
        $id = $this->input->post('id');
        //validate form input
        $this->form_validation->set_rules('first_name', $this->lang->line('edit_user_validation_fname_label'), 'required|xss_clean');
        $this->form_validation->set_rules('last_name', $this->lang->line('edit_user_validation_lname_label'), 'required|xss_clean');
        $this->form_validation->set_rules('email', lang('email'), 'required|xss_clean|valid_email');
        $this->form_validation->set_rules('groups', $this->lang->line('edit_user_validation_groups_label'), 'xss_clean');

        $data = array(
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'email' => $this->input->post('email'),
        );


        if ($this->conf->in_group($this->users->uid(), 'admin')) : //only admin can assign roles
            //Update the groups user belongs to
            $groupData = $this->input->post('groups');
            if (isset($groupData) && !empty($groupData)) {
                $this->ion_auth->remove_from_group('', $id);
                foreach ($groupData as $grp) {
                    $this->ion_auth->add_to_group($grp, $id);
                }
            }
        endif;

        //update the password if it was posted
        if ($this->input->post('password')) {
            $this->form_validation->set_rules('password', $this->lang->line('edit_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
            $this->form_validation->set_rules('password_confirm', $this->lang->line('edit_user_validation_password_confirm_label'), 'required');

            $data['password'] = $this->input->post('password');
        }

        if ($this->form_validation->run() === TRUE) {
            if ($this->ion_auth->update($id, $data)) {
                $this->conf->msg('success', lang('request_success'));
            } else {
                $this->conf->msg('danger', lang('request_error'));
            }
        } else {
            validation_errors();
            $this->conf->msg('danger');
        }

        $this->conf->redirectPrev();

    }

    function update_user_data($id)
    {
        //validate form input
        $this->form_validation->set_rules('pin', 'Pin', 'required|xss_clean|trim|integer');
        $this->form_validation->set_rules('street', lang('street'), 'required|xss_clean|trim');
        $this->form_validation->set_rules('street2', lang('street2'), 'xss_clean|trim');
        $this->form_validation->set_rules('city', lang('city'), 'required|xss_clean|trim');
        $this->form_validation->set_rules('state', lang('state'), 'required|xss_clean|trim');
        $this->form_validation->set_rules('zip', lang('zip'), 'required|xss_clean|trim');
        $this->form_validation->set_rules('country', lang('country'), 'required|xss_clean|trim');

        if ($this->form_validation->run() === TRUE) {
            if ($this->users->update_user_data($id)) {
                $this->conf->msg('success', lang('request_success'));
            } else {
                $this->conf->msg('danger', lang('request_error'));
            }

        } else {
            validation_errors();
            $this->conf->msg('success', '');

        }

        redirect('user/edit/' . $id);

    }

    /*
     * ensure all tables exist
     */

    function delete($id)
    {
        $this->conf->allow('admin');

        $data['user_id'] = $id;
        $this->conf->page('modules/users/confirm_delete', $data);

        if (isset($_POST['confirm'])) {
            if ($_POST['confirm'] == 'DELETE') {
                $this->db->where('id', $id);
                $this->db->delete('users');
                if ($this->db->affected_rows() > 0) {
                    $this->conf->msg('success', lang('request_success'));

                    $this->db->where('user_id', $id);
                    $this->db->delete('user_data');

                    redirect('users', 'refresh');
                } else {
                    $this->conf->msg('danger', lang('request_error'));
                    $this->conf->redirectPrev();
                }
            } else {
                $this->conf->msg('danger', lang('request_error'));
                $this->conf->redirectPrev();
            }
        }

    }

    // create a new group

    function create_group()
    {
        $this->data['title'] = $this->lang->line('create_group_title');

        $this->conf->allow('super');

        //validate form input
        $this->form_validation->set_rules('group_name', $this->lang->line('create_group_validation_name_label'), 'required|alpha_dash|xss_clean');
        $this->form_validation->set_rules('description', $this->lang->line('create_group_validation_desc_label'), 'xss_clean');

        if ($this->form_validation->run() == TRUE) {
            $new_group_id = $this->ion_auth->create_group($this->input->post('group_name'), $this->input->post('description'));
            if ($new_group_id) {
                // check to see if we are creating the group
                // redirect them back to the admin page
                $this->conf->msg('success', $this->ion_auth->messages());
            }
        } else {
            //display the create group form
            //set the flash data error message if there is one
            $this->conf->msg('danger', 'Error!');


        }
        redirect('users#create-group');
    }


    //update a group
    function update_group($id)
    {
        $this->conf->allow('super');
        // bail if no group id given
        if (!$id || empty($id)) {
            redirect('auth', 'refresh');
        }


        //validate form input
        $this->form_validation->set_rules('group_name', $this->lang->line('edit_group_validation_name_label'), 'required|alpha_dash|xss_clean');
        $this->form_validation->set_rules('group_description', $this->lang->line('edit_group_validation_desc_label'), 'xss_clean');


        if ($this->form_validation->run() === TRUE) {
            $group_update = $this->ion_auth->update_group($id, $_POST['group_name'], $_POST['group_description']);

            if ($group_update) {
                $this->conf->msg('success', $this->lang->line('edit_group_saved'));
            } else {

            }

        } else {
            $this->conf->msg('danger', $this->ion_auth->errors());
            redirect('users/edit_group/' . $id);
        }
        redirect('users#groups', 'refresh');

    }

    /*
     * edit group
     */
    function edit_group($id)
    {
        $this->conf->allow('super');

        $group = $this->ion_auth->group($id)->row();

        //pass the user to the view
        $this->data['group'] = $group;
        $this->conf->page($this->module . 'edit_group', $this->data);
    }


    /*
     * upload user photo
     */
    function uploadPhoto($id = "")
    {
        if (!$this->conf->isManager()) $this->conf->redirectPrev();
        $upload_path = './assets/img/users/staff';
        $upload_db = 'user_data';
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
            'max_size' => '2048',
            'max_width' => '1240',
            'max_height' => '1240',
            'encrypt_name' => true,
        );
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload()) {
            $this->conf->msg('danger', lang('request_error'));
        } else {
            //delete if any exists
            $this->db->where('user_id', $id);
            $q = $this->db->get($upload_db);
            foreach ($q->result() as $r) {
                if ($r->photo !== "") :
                    @unlink($upload_path . '/' . $r->photo);
                    $data['photo'] = '';
                    $this->db->where('user_id', $id);
                    $this->db->update($upload_db, $data);
                endif;
            }
            //upload new photo
            $upload_data = $this->upload->data();
            $data_ary = array(
                'photo' => $upload_data['file_name']
            );
            $this->db->where('user_id', $id);
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

}
