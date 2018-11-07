<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * User: John Muchiri
 * Date: 11/9/2014
 */
class MY_user extends CI_Model
{

    /**
     * @param       $password
     * @param       $email
     * @param array $additional_data
     * @param array $groups
     *
     * @return bool
     */
    public function reg($password, $email, $additional_data = [], $groups = [])
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
        $data = [
            'password' => $password,
            'email' => $email,
            'ip_address' => $ip_address,
            'created_at' => date_stamp(),
            'last_login' => date_stamp(),
            'active' => ($manual_activation === FALSE ? 1 : 0),

        ];
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
    function get($id = NULL, $item = '')
    {
        if($id == NULL) {
            $uid = $this->uid();
        } else {
            $uid = $id;
        }

        $query = $this->db->where('id', $uid)->get('users');

        if($query->num_rows() > 0) {
            $user = $query->row();

            if($item == 'name')
                return $user->first_name.' '.$user->last_name;

            if($item !== '')
                return $user->$item;

            return $user;
        }
        return FALSE;
        //return $this->db->get('users')->row();
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
            return TRUE;

        return FALSE;
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
        return FALSE;
    }


    function getCount($group = NULL)
    {
        if($group == NULL)
            return $this->db->count_all_results('users');

        $query = "SELECT g.name, count(*) AS total 
                  FROM users AS u
                  JOIN users_groups AS ug ON ug.user_id = u.id
                  JOIN groups AS g
                  ON g.id = ug.group_id
                  GROUP BY g.name;";
        $results = $this->db->query($query)->result();

        foreach ($results as $result) {
            if($result->name == $group)
                return $result->total;
        }

    }

    /*
     * get photo of user
     */
    function photo($photo = NULL)
    {
        if(empty($photo))
            $photo = 'assets/img/content/no-image.png';
        else
            $photo = 'assets/uploads/users/'.$photo;

        return base_url($photo);
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