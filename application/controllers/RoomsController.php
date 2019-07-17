<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class RoomsController extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        //redirect session
        setRedirect();
        auth(TRUE);
        //local variables
        $this->module = 'rooms/';
        $this->load->model('My_meal', 'meal');
        $this->load->model('My_activity', 'activity');
    }

    /*
     * display main page
     */
    function index($daycare_id = NULL)
    {
        allow(['admin', 'manager', 'staff']);

        if(is('staff'))
            $rooms = $this->user->rooms(user_id());
        else
            $rooms = $this->rooms->all();            

        $this->title = lang('rooms');
        dashboard_page($this->module.'rooms', compact('rooms'),$daycare_id);
    }    
    function view()
    {
        allow(['admin', 'manager', 'staff']);

        $id = $this->uri->segment(3);

        $room = $this->rooms->getRoom($id);       
//        $room = $this->db->where('id', $id)->get('child_rooms')->row();
        $this->title = $room->name.' '.lang('room');

        if(count((array)$room) == 0)
            show_404();

        $allStaff = $this->user->staff();
        $allChildren = $this->child->children()->result();
        $mealTypes = $this->meal->mealTypes();
        $days = $this->meal->days();

        page($this->module.'room-view', compact('room', 'allStaff', 'allChildren', 'mealTypes', 'days'));
    }

    function store()
    {
        allow(['admin', 'manager']);

        $this->form_validation->set_rules('name', lang('name'), 'required|xss_clean|trim|is_unique[child_rooms.name]');
        $this->form_validation->set_rules('description', lang('description'), 'xss_clean|trim');

        if($this->form_validation->run() == TRUE) {

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
        allow(['admin', 'manager']);

        $this->form_validation->set_rules('name', lang('name'), 'required|xss_clean|trim|callback_check_room_name');
        $this->form_validation->set_rules('description', lang('description'), 'xss_clean|trim');

        if($this->form_validation->run() == TRUE) {

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
     *
     * @return bool
     */
    function check_room_name($name)
    {
        $id = $this->input->post('room_id');
        $result = $this->rooms->check_unique_name($id, $name);

        if($result == 0)
            $response = TRUE;
        else {
            $this->form_validation->set_message('check_room_name', lang('Name must be unique'));
            $response = FALSE;
        }
        return $response;
    }

    function destroy()
    {
        allow(['admin', 'manager']);

        $id = $this->uri->segment(3);

        $this->db->where('room_id', $id)->delete('child_room');
        $this->db->where('id', $id)->delete('child_rooms');
        logEvent($user_id = NULL, "Deleted room {$this->rooms->rooms($id)->name}",$care_id = NULL);
        flash('success', lang('Room has been deleted'));

        redirect('rooms');
    }

    function assignChildren()
    {
        allow(['admin', 'manager']);

        $this->form_validation->set_rules('child_id[]', lang('children'), 'required|trim|xss_clean');
        $this->form_validation->set_rules('room_id', lang('room'), 'required|trim|xss_clean');
        if($this->form_validation->run() == TRUE) {

            $room = $this->input->post('room_id');

            foreach ($this->input->post('child_id') as $child) {
                $find =$this->db->limit(1)->where('child_id', $child)->where('room_id', $room)->count_all_results('child_room');
                if($find == 0) {
                    $this->db->insert('child_room', [
                        'child_id' => $child,
                        'room_id' => $room,
                        'created_at' => date_stamp(),
                    ]);
                }
                logEvent($user_id = NULL,"Assigned child {$this->child->child($child)->first_name} for room {$this->rooms->rooms($room)->name}",$care_id = NULL);
            }

            flash('success', lang('request_success'));
        } else {

            validation_errors();
            flash('error');

        }

        redirect('rooms/view/'.$this->input->post('room_id'));
    }

    function assignStaff()
    {
        allow(['admin', 'manager']);

        $this->form_validation->set_rules('user_id[]', lang('staff'), 'required|trim|xss_clean');
        $this->form_validation->set_rules('room_id', lang('room'), 'required|trim|xss_clean');
        if($this->form_validation->run() == TRUE) {

            $room = $this->input->post('room_id');

            foreach ($this->input->post('user_id') as $user) {
                $find =$this->db->limit(1)->where('user_id', $user)->where('room_id', $room)->count_all_results('child_room_staff');
                if($find == 0) {
                    $this->db->insert('child_room_staff', [
                        'user_id' => $user,
                        'room_id' => $room,
                        'created_at' => date_stamp(),
                    ]);
                }                
                logEvent($user_id = NULL, "Assigned staff user {$this->user->first($user)->first_name} for room {$this->rooms->rooms($room)->name}",$care_id = NULL);
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

    function notes()
    {
        allow(['admin', 'manager', 'staff']);
    }

    function addNote()
    {
        allow(['admin', 'manager', 'staff']);

        $this->form_validation->set_rules('notes', lang('Notes'), 'required|xss_clean|trim');

        if($this->form_validation->run() == TRUE) {

            if($this->rooms->addNote())
                flash('success', lang('request_success'));
            else
                flash('error', lang('request_error'));

        } else {

            validation_errors();
            flash('error');
        }

        redirectPrev();
    }

    function deleteNote()
    {
        allow(['admin', 'manager', 'staff']);

        $id = $this->uri->segment(3);
        $room_notes_detail = $this->db->get_where('child_room_notes',array(
            'id' => $id
        ));
        $room_notes = $room_notes_detail->row();
        if(is('staff')) {
            $note = $this->db->where('id', $id)->get('child_room_notes')->row();
            if($note->user_id !== user_id())
            {
                redirectPrev(lang('Access denied'),'','error');
            }
        }

        $this->db->where('id', $id)->delete('child_room_notes');
        $room_id = $room_notes->room_id;
        logEvent($user_id = NULL, "Deleted note {$room_notes->content} for room {$this->rooms->rooms($room_id)->name}",$care_id = NULL);
        flash('success', lang('request_success'));

        redirectPrev();
    }

    function detachStaff()
    {
        allow(['admin', 'manager']);
        $user_id = uri_segment(4);
        $room_id = uri_segment(3);
        $this->db->where('room_id', $room_id)->where('user_id', $user_id)->delete('child_room_staff');
        logEvent($id = NULL,"Detached staff user {$this->user->first($user_id)->first_name} for room {$this->rooms->rooms($room_id)->name}",$care_id = NULL);
        flash('success', lang('request_success'));

        redirectPrev();
    }

    function detachChild()
    {
        allow(['admin', 'manager']);
        $room_id = uri_segment(3);
        $child_id = uri_segment(4);
        $this->db->where('room_id', $room_id)->where('child_id', $child_id)->delete('child_room');
        logEvent($user_id = NULL, "Detached child {$this->child->child($child_id)->first_name} for room {$this->rooms->rooms($room_id)->name}",$care_id = NULL);
        flash('success', lang('request_success'));

        redirectPrev();
    }
}