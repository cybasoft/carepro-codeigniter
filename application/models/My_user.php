<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * User: John Muchiri
 * Date: 11/9/2014
 */
class MY_user extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    /**
     * @param       $password
     * @param       $email
     * @param array $additional_data
     * @param array $groups
     *
     * @return bool
     */
    public function reg($password, $email, $additional_data = array(), $groups = array())
    {
        $this->load->model('ion_auth_model');
        $this->ion_auth->trigger_events('pre_register');
        $manual_activation = $this->config->item('manual_activation', 'ion_auth');
        if($this->ion_auth->email_check($email)) {
            $this->ion_auth->set_error('account_creation_duplicate_email');
            return FALSE;
        }

        // IP Address
        $ip_address = $this->input->ip_address();
        $password = $this->ion_auth->hash_password($password);
        // Users table.
        $data = array(
            'password' => $password,
            'email' => $email,
            'ip_address' => $ip_address,
            'created_at' => date_stamp(),
            'last_login' => date_stamp(),
            'active' => ($manual_activation === false ? 1 : 0)

        );
        //filter out any data passed that doesnt have a matching column in the users table
        //and merge the set user data and the additional data
        $userData = array_merge($this->ion_auth->_filter_data('users', $additional_data), $data);
        $this->ion_auth->trigger_events('extra_set');
        $this->db->insert('users', $userData);
        $id = $this->db->insert_id();

        if(!empty($groups)) {
            //add to groups
            foreach ($groups as $group) {
                $this->ion_auth->add_to_group($group, $id);
            }
        }
        //add to default group if not already set
        $default_group = $this->ion_auth->where('name', $this->config->item('default_reg_group', 'ion_auth'))->group()->row();
        if((isset($default_group->id) && empty($groups)) || (!empty($groups) && !in_array($default_group->id, $groups))) {
            $this->ion_auth->add_to_group($default_group->id, $id);
        }
        $this->ion_auth->trigger_events('post_register');
        return (isset($id)) ? $id : FALSE;
    }

    function users()
    {
        $this->db->select('*');
        $this->db->from('users');
        return $this->db->get();
    }

    /**
     * @param $id
     *
     * @return bool
     */
    function first($id)
    {
        return $this->user($id);
    }

    /**
     * @param null $id
     *
     * @return bool
     */
    function user($id = null)
    {
        if($id == null) {
            $uid = $this->uid();
        } else {
            $uid = $id;
        }
        $query = $this->db->where('id', $uid)->get('users');
        if($query->num_rows() > 0) {
            return $query->row();
        }
        return false;
        //return $this->db->get('users')->row();
    }

    /**
     * @param $id
     * @param $item
     *
     * @return string
     */
    function get($id, $item = '')
    {
        $user = $this->user($id);
        if($user !== false && !empty($item)) {
            if(is_array($item)) {
                $u = '';
                foreach ($item as $i) {
                    $u .= $user->$i;
                }
                return $u;
            } else {
                if($item == 'name')
                    return $user->first_name.' '.$user->last_name;

                $user = (array)$user;
                return $user[$item];
            }

        }
        return '';
    }

    /**
     * @param $user
     * @param $group
     *
     * @return bool
     */
    function in_group($user, $group)
    {
        $this->db->select('*');
        $this->db->where('groups.name', $group);
        $this->db->where('users_groups.user_id', $user);
        $this->db->from('users_groups');
        $this->db->join('groups', 'users_groups.group_id=groups.id');

        if($this->db->get()->num_rows() > 0)
            return true;

        return false;
    }

    function uid()
    {
        return $this->session->userdata('user_id');
    }

    /**
     * @param $item
     *
     * @return string
     */
    function thisUser($item)
    {
        /*registered session data on login
        - user_id
        - username
        - status
         */
        $this->db->select('id,first_name,last_name,email');
        $this->db->where('id', $this->uid());
        $res = $this->db->get('users')->row();
        if(count((array)$res) > 0)
            return $res->$item;
        return "";
    }


    function getUser($id = "", $item)
    {
        if($id !== "") {
            $this->db->where('id', $id);
            $q = $this->db->get('users');
            foreach ($q->result() as $row) {
                return $row->$item;
            }
        }
        return false;
    }


    function getCount($group = null)
    {
        if($group !== null)
            return $this->db->where('groups.name', $group)
                ->from('users')
                ->join('users_groups', 'users_groups.user_id=users.id')
                ->join('groups', 'groups.id=users_groups.group_id')
                ->count_all_results();

        return $this->users()->num_rows();
    }

    /*
     * get photo of user
     */
    function photo($photo = NULL)
    {
        $defaultPhoto = 'assets/img/content/no-image.png';
        if(is_numeric($photo)) {
            $user = $this->db->where('id', $photo)->get('users')->row();
            if(count((array)$user) > 0 && !empty($user->photo))
                $defaultPhoto = 'assets/uploads/users/'.$user->photo;
        }

        $photo = $defaultPhoto;

        return base_url().$photo;
    }

    /**
     * @param $id
     *
     * @return int
     */
    function groupCount($id)
    {
        $this->db->where('group_id', $id);
        $res = $this->db->count_all_results('users_groups');
        if(count((array)$res) > 0)
            return $res;
        return 0;
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    function getGroups($id)
    {
        return $this->ion_auth->get_users_groups($id)->result();
    }

    /**
     * @return mixed
     */
    function staff()
    {
        $staff = $this->db->select('users.id,users.first_name,users.last_name,users_groups.group_id')
            ->where('group_id', 1)
            ->or_where('group_id', 2)
            ->or_where('group_id', 3)
            ->or_where('group_id', 4)
            ->from('users')
            ->join('users_groups', 'users_groups.user_id=users.id')
            ->get()->result();
        return $staff;
    }

    /**
     * Get all rooms user is assigned
     *
     * @param $id
     *
     * @return mixed
     */
    function rooms($id)
    {
        return $this->db->select('child_rooms.*')
            ->from('child_rooms')
            ->join('child_room_staff', 'child_room_staff.user_id=child_rooms.id')
            ->where('child_room_staff.user_id', $id)
            ->get()
            ->result();
    }
}