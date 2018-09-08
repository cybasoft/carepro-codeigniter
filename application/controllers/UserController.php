<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @author: JMuchiri.
 */
class UserController extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        setRedirect();
        allow(['admin', 'manager', 'staff']);
        $this->module = 'users/';
        $this->title = lang('users');
    }

    //redirect if needed, otherwise display the user list
    function index()
    {
        //list the users
        $users = $this->db->select('u.*,ug.group_id,g.name as role')
            ->from('users as u')
            ->join('users_groups as ug','ug.user_id=u.id','left')
            ->join('groups as g','g.id=ug.group_id')
            ->get()->result();



//        foreach ($users as $k => $user) {
//            $users[$k]->groups = $this->db->select('name')
//                ->from('groups')
//                ->join('users_groups', 'users_groups.group_id=groups.id')
//                ->where('user_id', $user->id)->get()->result();
//            foreach ($user->groups as $group) {
//                $count[$group->name] = $count[$group->name] + 1;
//            }
//        }

        $groups = $this->db->select('g.name, count(*) AS total')
            ->from('users as u')
            ->join('users_groups as ug','ug.user_id=u.id')
            ->join('groups as g','g.id=ug.group_id')
            ->group_by('g.name')
            ->get()->result();

       $role=[];

        for($i=0; $i<count((array)$groups); $i++){
            $role[$groups[$i]->name] = $groups[$i]->total;
        }
        page($this->module.'index', compact('users', 'count','role'));
    }

    //create a new user
    function create()
    {
        $tables = $this->config->item('tables', 'ion_auth');
        //validate form input
        $this->form_validation->set_rules('first_name', lang('first_name'), 'required|xss_clean|min_length[2]');
        $this->form_validation->set_rules('last_name', lang('last_name'), 'required|xss_clean|min_length[2]');
        $this->form_validation->set_rules('email', lang('email'), 'required|valid_email|is_unique['.$tables['users'].'.email]');
        $this->form_validation->set_rules('phone', lang('phone'), 'required|xss_clean');
        $this->form_validation->set_rules('password', lang('password'), 'required|min_length['.$this->config->item('min_password_length', 'ion_auth').']|max_length['.$this->config->item('max_password_length', 'ion_auth').']|matches[password_confirm]');
        $this->form_validation->set_rules('password_confirm', lang('password_confirm'), 'required');
        $this->form_validation->set_rules('group', '', 'trim');

        if($this->form_validation->run() == true) {
            $additional_data = array(
                'email' => strtolower($this->input->post('email')),
                'password' => $this->input->post('password'),
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'phone' => $this->input->post('phone'),
            );
            $group = $this->input->post('group');
            if($this->ion_auth->register($additional_data, $group)) {
                flash('success', lang('request_success'));
            }
        } else {
            set_flash(['email', 'first_name', 'last_name', 'phone', 'group']);
            validation_errors();
            flash('danger');
        }
        redirectPrev();
    }

    function view()
    {
        disable_debug();

        allow(['admin', 'manager']);

        $id = $this->uri->segment(3);

        if(empty($id) || !is_numeric($id)) {
            show_404();
        }
        //user vars
        $user = $this->ion_auth->user($id)->row();
        $groups = $this->ion_auth->groups()->result_array();
        $currentGroups = $this->ion_auth->get_users_groups($id)->result();
        //pass the user to the view
        $myData = array(
            'user' => $user,
            'groups' => $groups,
            'currentGroups' => $currentGroups
        );
        $this->load->view($this->module.'edit_user', $myData);
    }

    //edit a user
    function update()
    {
        allow(['admin', 'manager']);
        $id = $this->input->post('user_id');
        //validate form input
        $this->form_validation->set_rules('first_name', lang('edit_user_validation_first_name_label'), 'required|xss_clean');
        $this->form_validation->set_rules('last_name', lang('edit_user_validation_last_name_label'), 'required|xss_clean');
        $this->form_validation->set_rules('email', lang('email'), 'required|xss_clean|valid_email');
        $this->form_validation->set_rules('groups', lang('edit_user_validation_groups_label'), 'xss_clean');
        $this->form_validation->set_rules('pin', lang('pin'), 'required|xss_clean|trim|integer');
        $this->form_validation->set_rules('address', lang('address'), 'xss_clean|trim');
        $data = array(
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'email' => $this->input->post('email'),
            'pin' => $this->input->post('pin'),
            'phone' => $this->input->post('phone'),
            'phone2' => $this->input->post('phone2'),
            'address' => $this->input->post('address')
        );
        if(is('admin')) : //only admin can assign roles
            //Update the groups user belongs to
            $groupData = $this->input->post('groups');
            if(isset($groupData) && !empty($groupData)) {
                $this->ion_auth->remove_from_group('', $id);
                foreach ($groupData as $grp) {
                    $this->ion_auth->add_to_group($grp, $id);
                }
            }
        endif;

        //update the password if it was posted
        if($this->input->post('password')) {
            $this->form_validation->set_rules('password', lang('edit_user_validation_password_label'), 'required|min_length['.$this->config->item('min_password_length', 'ion_auth').']|max_length['.$this->config->item('max_password_length', 'ion_auth').']|matches[password_confirm]');
            $this->form_validation->set_rules('password_confirm', lang('edit_user_validation_password_confirm_label'), 'required');

            $data['password'] = $this->input->post('password');
        }
        if($this->form_validation->run() === TRUE) {
            if($this->ion_auth->update($id, $data)) {
                //update photo if available
                flash('success', lang('request_success'));
                if(!empty($_FILES['userfile']['name'])) {
                    $this->uploadPhoto($id);
                }
            } else {
                flash('danger', lang('request_error'));
            }
        } else {
            validation_errors();
            flash('danger');
        }
        redirectPrev();
    }

    //activate the user
    function activate()
    {
        allow('admin');
        $id = uri_segment(3);
        $code = uri_segment(4);
        if(!empty($code)) {
            $activation = $this->ion_auth->activate($id, $code);
        } else {
            $activation = $this->ion_auth->activate($id);
        }
        if($activation) {
            //redirect them to the auth page
            flash('success', lang('user_activated'));
        } else {
            //redirect them to the forgot password page
            flash('danger', lang('request_error'));
        }
        redirect("users", 'refresh');
    }

    //deactivate the user
    function deactivate()
    {
        allow('admin');
        $id = (int)$this->uri->segment(3);
        $this->load->library('form_validation');
        $this->form_validation->set_rules('confirm', lang('deactivate_validation_confirm_label'), 'required');
        if($this->form_validation->run() == FALSE) {
            if($this->input->post('confirm')) {
                validation_errors();
                flash('danger');
            }
            page($this->module.'deactivate_user', compact('id'));
        } else {
            if($this->input->post('confirm') == 'yes') {
                $this->ion_auth->deactivate($id);
                flash('warning', lang('user_deactivated'));
            } else {
                flash('info', lang('action_cancelled'));
            }
            redirect("users", 'refresh');
        }
    }

    /*
     * ensure all tables exist
     */

    function delete()
    {
        allow('admin');

        $this->db->where('id', $this->uri->segment(3));
        $this->db->delete('users');
        if($this->db->affected_rows() > 0)
            flash('success', lang('request_success'));
        else
            flash('danger', lang('request_error'));

        redirect('users', 'refresh');
    }

    // create a new group

    function create_group()
    {
        $this->data['title'] = lang('create_group_title');
        allow('admin');
        //validate form input
        $this->form_validation->set_rules('group_name', lang('create_group_validation_name_label'), 'required|alpha_dash|xss_clean');
        $this->form_validation->set_rules('description', lang('create_group_validation_desc_label'), 'xss_clean');

        if($this->form_validation->run() == TRUE) {
            $new_group_id = $this->ion_auth->create_group($this->input->post('group_name'), $this->input->post('description'));
            if($new_group_id) {
                // check to see if we are creating the group
                // redirect them back to the admin page
                flash('success', $this->ion_auth->messages());
            }
        } else {
            //display the create group form
            //set the flash data error message if there is one
            flash('danger', 'Error!');
        }
        redirect('users#create-group');
    }

    //update a group
    function update_group()
    {
        $id = uri_segment(3);

        allow('admin');
        if(!$id || empty($id)) {
            redirect('auth', 'refresh');
        }
        //validate form input
        $this->form_validation->set_rules('group_name', lang('edit_group_validation_name_label'), 'required|alpha_dash|xss_clean');
        $this->form_validation->set_rules('group_description', lang('edit_group_validation_desc_label'), 'xss_clean');
        if($this->form_validation->run() === TRUE) {
            $group_update = $this->ion_auth->update_group($id, $_POST['group_name'], $_POST['group_description']);
            if($group_update) {
                flash('success', lang('edit_group_saved'));
            } else {
                flash('error', lang('request_error'));
            }

        } else {
            flash('danger', $this->ion_auth->errors());
            redirect('users/edit_group/'.$id);
        }
        redirect('users#groups', 'refresh');

    }

    /*
     * edit group
     */
    function edit_group()
    {
        $id = uri_segment(3);
        allow('admin');
        $group = $this->ion_auth->group($id)->row();
        //pass the user to the view
        $this->data['group'] = $group;
        page($this->module.'edit_group', $this->data);
    }

    /*
     * upload user photo
     */
    function uploadPhoto()
    {
        $id = uri_segment(3);

        $upload_path = APPPATH.'../assets/uploads/users';
        $upload_db = 'users';
        if(!file_exists($upload_path)) {
            mkdir($upload_path, 755, true);
        }
        if($id == "") { //make sure there are arguments
            flash('danger', lang('request_error'));
            redirectPrev();
        }
        $config = array(
            'upload_path' => $upload_path,
            'allowed_types' => 'gif|jpg|png|jpeg|svg',
            'max_size' => '2048',
            'max_width' => '1240',
            'max_height' => '1240',
            'encrypt_name' => true,
        );
        $this->load->library('upload', $config);
        if(!$this->upload->do_upload()) {
            flash('error', $this->upload->display_errors());
            return false;
        } else {
            //delete if any exists
            $q = $this->db->where('id', $id)->get($upload_db);
            foreach ($q->result() as $r) {
                if($r->photo !== "") :
                    @unlink($upload_path.'/'.$r->photo);
                    $data['photo'] = '';
                    $this->db->where('id', $id)->update($upload_db, $data);
                endif;
            }
            //upload new photo
            $upload_data = $this->upload->data();
            $data_ary = array(
                'photo' => $upload_data['file_name']
            );
            $this->db->where('id', $id)->update($upload_db, $data_ary);
            $data = array('upload_data' => $upload_data);
            if($data) {
                flash('success', lang('request_success'));
            } else {
                flash('danger', lang('request_error'));
            }
        }
    }


    /**
     * Get all rooms a user is assigned to
     *
     * @param $staff_id
     *
     * @return mixed
     */
    function rooms($staff_id)
    {
        $result = $this->db->select('child_rooms.*', 'child_room_staff.room_id', 'child_room_staff.created_at as staff_add_data')
            ->from('child_rooms')
            ->join('child_room_staff', 'child_room_staff.room_id=child_rooms.id')
            ->where('child_room_staff.staff_id', $staff_id)
            ->get()
            ->result();
        return $result;
    }

}
