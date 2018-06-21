<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class notes extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        auth(true);
        //local variables
        $this->module = 'modules/child/notes/';
        $this->load->helper('text');
        $this->load->model('My_photos','photos');
        $this->title = lang('child').'-'.lang('notes');
    }

    function index($id)
    {
        $child = $this->child->first($id);
        if(!authorizedToChild($this->user->uid(),$id)){
            flash('error',lang('You do not have permission to view this child\'s profile'));
            redirectPrev();
        }

        if (empty($child)) {
            flash('error', lang('request_error'));
            redirect('dashboard', 'refresh');
        }
        $notes = $this->db
            ->where('child_id', $child->id)
            ->order_by('created_at', 'DESC')
            ->get('child_notes')
            ->result();
        $incidents = $this->db
            ->where('child_id', $child->id)
            ->order_by('created_at', 'DESC')
            ->get('child_incident')
            ->result();
        page($this->module . 'index', compact('child', 'notes', 'incidents'));
    }

    /*
     * add note for selected child
     * @return void
     */
    function addNote($child_id)
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('title', lang('title'), 'required|trim|xss_clean');
        $this->form_validation->set_rules('note-content', lang('content'), 'required|trim');
        if ($this->form_validation->run() == TRUE) {
            if ($this->child->createNote($child_id)) {
                flash('success', lang('request_success'));
            } else {
                flash('error', lang('request_error'));
            }
        } else {
            flash('danger');
            validation_errors();
        }
        redirect('child/' . $child_id . '/notes', 'refresh');
    }

    /*
     * delete note
     */
    function deleteNote($id)
    {
        allow('admin,manager,staff');
        $this->db->where('id', $id);
        $this->db->delete('child_notes');
        if ($this->db->affected_rows() > 0) {
            flash('success', lang('request_success'));
        } else {
            flash('danger', lang('request_danger'));
        }
        redirectPrev();
    }

    /**
     * create incident
     * @param $child_id
     */
    function createIncident($child_id)
    {
        allow('admin,manager,staff');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('title', lang('title'), 'required|trim|xss_clean');
        $this->form_validation->set_rules('location', lang('location'), 'required|trim|xss_clean');
        $this->form_validation->set_rules('incident_type', lang('incident_type'), 'required|trim|xss_clean');
        $this->form_validation->set_rules('description', lang('description'), 'required|trim');
        $this->form_validation->set_rules('actions_taken', lang('actions_taken'), 'required|trim|xss_clean');
        $this->form_validation->set_rules('witnesses', lang('witnesses'), 'required|trim|xss_clean');
        $this->form_validation->set_rules('remarks', lang('remarks'), 'trim|xss_clean');
        $this->form_validation->set_rules('date', lang('remarks'), 'required|trim|xss_clean');
        $this->form_validation->set_rules('time', lang('remarks'), 'required|trim|xss_clean');
        if ($this->form_validation->run() == TRUE) {
            if ($this->child->createIncident($child_id)) {
                flash('success', lang('request_success'));
            } else {
                flash('danger', lang('request_danger'));
            }
        } else {
            flash('danger');
            validation_errors();
        }
        redirect('child/' . $child_id . '/notes', 'refresh');
    }

    function addIncidentPhotos(){
        $chidID = $this->input->post('child_id');
        echo $this->photos->incident($chidID);
    }

    /*
     * delete incident
     */
    function deleteIncident($id)
    {
        allow('admin,manager');
        //delete photos
        $photos = $this->db->where('incident_id',$id)->get('child_incident_photos');
        if($photos->num_rows() >0){
            foreach($photos->result() as $photo){
                @unlink('./assets/uploads/photos/'.$photo->photo);
            }
            $this->db->where('incident_id',$id)->delete('child_incident_photos');
        }
        //delete incident
        $this->db->where('id', $id);
        $this->db->delete('child_incident');
        if ($this->db->affected_rows() > 0) {
            flash('success', lang('request_success'));
        } else {
            flash('danger', lang('request_danger'));
        }
        redirectPrev();
    }

}