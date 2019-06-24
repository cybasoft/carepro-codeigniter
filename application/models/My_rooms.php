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
        $daycare_id = $this->session->userdata('daycare_id');       
        $res= $this->db->where('daycare_id',$daycare_id)->get($this->table)->result();
        foreach($res as $key=>$r){
            $res[$key]->total_children=$this->db->where('room_id',$r->id)->count_all_results('child_room');
            $res[$key]->total_staff = $this->db->where('room_id',$r->id)->count_all_results('child_room_staff');
        }
        return $res;
    }

    function getRoom($id)
    {
        $room = $this->db->where('id', $id)->get('child_rooms')->row();

        $room->children = $this->db->select('children.id as child_id,children.first_name,children.last_name,children.photo,child_rooms.name,child_rooms.description,child_room.child_id,child_room.room_id')
            ->from('children')
            ->join('child_room', 'child_room.child_id=children.id')
            ->join('child_rooms', 'child_rooms.id=child_room.room_id')
            ->where('child_rooms.id', $id)
            ->get()->result();

        $room->staff = $this->db->select('*')
            ->from('users')
            ->join('child_room_staff', 'child_room_staff.user_id=users.id')
            ->where('child_room_staff.room_id', $id)
            ->get()->result();

        $room->notes = $this->db->select("crn.*,concat(u.first_name, ' ', u.last_name) as name, u.photo")
            ->from('child_room_notes crn')
            ->join('users u', 'u.id=crn.user_id')
            ->where('crn.room_id', $id)
            ->order_by('crn.created_at', 'desc')
            ->get()->result();

        $room->meals = $this->meal->meals($id);
        $room->activities = $this->activity->activities($id);

        return $room;
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
        $daycare_id = $this->session->userdata('daycare_id');       
        $this->db->insert($this->table,
            [
                'name' => $this->input->post('name'),
                'description' => $this->input->post('description'),
                'created_at' => date_stamp(),
                'daycare_id' => $daycare_id
            ]
        );

        if($this->db->affected_rows() > 0)
            $last_id = $this->db->insert_id();
            logEvent($user_id = NULL,"Added room ID: {$last_id}");
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
            logEvent($user_id = NULL, "Updated room ID: {$this->input->post('room_id')}");
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
        $children = $this->db->select('children.id as child_id,children.first_name,children.last_name,children.photo,'.$this->table.'.name,'.$this->table.'.description,child_room.child_id,child_room.room_id')
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
        return $this->db->select('crn.*,u.photo')
            ->from('child_room_notes crn')
            ->join('users u', 'u.id=crn.user_id')
            ->where('crn.room_id', $id)
            ->order_by('crn.created_at', 'desc')
            ->get()
            ->result();

//        return $this->db->where('room_id', $id)
//            ->order_by('created_at', 'desc')
//            ->get('child_room_notes')
//            ->result();
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
            $last_id = $this->db->insert_id();
            logEvent($user_id = NULL, "Added note ID: {$last_id} for room ID: {$this->input->post('room_id')}");
            return TRUE;

        return FALSE;
    }
}