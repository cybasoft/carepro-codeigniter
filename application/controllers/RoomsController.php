<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class RoomsController extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        //redirect session
        setRedirect();
        auth(true);
        //local variables
        $this->module = 'modules/rooms/';
    }

    /*
     * display main page
     */
    function index()
    {
        allow(['admin','manager','staff']);

        if(is('staff'))
            $rooms = $this->user->rooms(user_id());
        else
            $rooms = $this->rooms->all();

        $this->title = lang('rooms');
        page($this->module.'index',compact('rooms'));
    }

    function view()
    {
        allow(['admin','manager','staff']);

        $id = $this->uri->segment(3);

        $room = $this->db->where('id', $id)->get('child_rooms')->row();
        $this->title = $room->name.' '.lang('room');

        if(count((array)$room) == 0)
            show_404();

        $children = $this->rooms->children($id);

        $staff = $this->rooms->staff($id);

        $allStaff = $this->users->staff();

        $allChildren = $this->child->children()->result();

        $notes = $this->rooms->notes($id);

        page($this->module.'view', compact('room', 'children', 'staff', 'allStaff', 'allChildren','notes'));
    }

    function store()
    {
        allow(['admin','manager']);

        $this->form_validation->set_rules('name', lang('name'), 'required|xss_clean|trim|is_unique[child_rooms.name]');
        $this->form_validation->set_rules('description', lang('description'), 'xss_clean|trim');

        if($this->form_validation->run() == true) {

            if($this->rooms->store()):
                flash('success', lang('Child room created! You can now assign children'));
            else:
                flash('error', lang('request_error'));
            endif;

        } else {
            validation_errors();
            flash('error');
        }

        redirect('rooms');
    }

    function update()
    {
        allow(['admin','manager']);

        $this->form_validation->set_rules('name', lang('name'), 'required|xss_clean|trim|callback_check_room_name');
        $this->form_validation->set_rules('description', lang('description'), 'xss_clean|trim');

        if($this->form_validation->run() == true) {

            if($this->rooms->update()):
                flash('success', lang('Room has been updated'));
            else:
                flash('error', lang('request_error'));
            endif;

        } else {
            validation_errors();
            flash('error');
        }

        redirectPrev();
    }

    /**
     * @param $name
     * @return bool
     */
    function check_room_name($name)
    {
        $id = $this->input->post('room_id');
        $result = $this->rooms->check_unique_name($id, $name);

        if($result == 0)
            $response = true;
        else {
            $this->form_validation->set_message('check_room_name', lang('Name must be unique'));
            $response = false;
        }
        return $response;
    }

    function destroy()
    {
        $id = $this->uri->segment(3);

        $this->db->where('room_id',$id)->delete('child_room');
        $this->db->where('id',$id)->delete('child_rooms');

        flash('success',lang('Room has been deleted'));

        redirect('rooms');
    }

    function assignChildren()
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

        redirect('rooms/view/'.$this->input->post('room_id'));
    }

    function removeChild()
    {
    }

    function assignStaff()
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
                    'created_at' => date_stamp()
                ]);

            }

            flash('success', lang('request_success'));
        } else {

            validation_errors();
            flash('error');

        }

        redirect('rooms/view/'.$this->input->post('room_id'));
    }

    function removeStaff()
    {
    }

    function notes(){
        allow(['admin','manager','staff']);
    }

    function addNote(){
        allow(['admin','manager','staff']);

        $this->form_validation->set_rules('notes',lang('Notes') ,'required|xss_clean|trim' );

        if($this->form_validation->run() == true) {

            if($this->rooms->addNote())
                flash('success',lang('request_success'));
            else
                flash('error',lang('request_error'));

        } else {

            validation_errors();
            flash('error');
        }

        redirectPrev();
    }

    function deleteNote(){
        allow(['admin','manager','staff']);

        $this->db->where('id',$this->uri->segment(3))->delete('child_room_notes');

        flash('success',lang('request_success'));

        redirectPrev();
    }
}