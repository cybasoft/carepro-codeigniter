<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class My_rooms extends CI_Model
{

    protected $table = 'child_rooms';

    /**
     * retrieve all rooms
     *
     * @return mixed
     */
    function all()
    {
        return $this->db->get($this->table)->result();
    }

    /**
     * @return mixed
     */
    function getCount()
    {
        return $this->db->count_all_results($this->table);
    }

    /**
     * @return bool
     */
    function store()
    {
        $this->db->insert($this->table,
            [
                'name' => $this->input->post('name'),
                'description' => $this->input->post('description'),
                'created_at' => date_stamp(),
            ]
        );

        if($this->db->affected_rows() > 0)
            return TRUE;

        return FALSE;
    }

    /**
     * @return bool
     */
    function update()
    {
        $this->db->update($this->table,
            [
                'name' => $this->input->post('name'),
                'description' => $this->input->post('description'),
                'created_at' => date_stamp(),
            ],
            ['id' => $this->input->post('room_id')]
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
    function children($id)
    {
        $children = $this->db->select('children.id as child_id,children.first_name,children.last_name,'.$this->table.'.name,'.$this->table.'.description,child_room.child_id,child_room.room_id')
            ->from('children')
            ->join('child_room', 'child_room.child_id=children.id')
            ->join($this->table, $this->table.'.id=child_room.room_id')
            ->where($this->table.'.id', $id)
            ->get()
            ->result();
        return $children;
    }

    /**
     * Get all users assinged to a room
     *
     * @param $id
     *
     * @return mixed
     */
    function staff($id)
    {
        $staff = $this->db->select('*')
            ->from('users')
            ->join('child_room_staff', 'child_room_staff.user_id=users.id')
            ->where('child_room_staff.room_id', $id)
            ->get()
            ->result();
        return $staff;
    }

    /**
     * @param string $id
     * @param        $name
     *
     * @return mixed
     */
    function check_unique_name($id = '', $name)
    {
        $this->db->where('name', $name);
        if($id) {
            $this->db->where_not_in('id', $id);
        }
        return $this->db->get($this->table)->num_rows();
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    function notes($id)
    {
        return $this->db->where('room_id', $id)
            ->order_by('created_at', 'desc')
            ->get('child_room_notes')
            ->result();
    }

    /**
     * @return bool
     */
    function addNote()
    {
        $data = [
            'user_id' => $this->user->uid(),
            'room_id' => $this->input->post('room_id'),
            'content' => $this->input->post('notes'),
            'created_at' => date_stamp(),
        ];
        $this->db->insert('child_room_notes', $data);

        if($this->db->affected_rows() > 0)
            return TRUE;

        return FALSE;
    }
}