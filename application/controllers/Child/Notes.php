<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class notes extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        auth(true);
        //local variables
        $this->module = 'modules/child/notes/';
        $this->load->helper('text');
        $this->load->model('My_photos', 'photos');
        $this->load->model('My_notes', 'notes');
        $this->title = lang('child').'-'.lang('notes');
    }

    function index()
    {
        $id = $this->uri->segment(2);
        $child = $this->child->first($id);
        if(!authorizedToChild($this->user->uid(), $id)) {
            flash('error', lang('You do not have permission to view this child\'s profile'));
            redirectPrev();
        }
        if(empty($child)) {
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
        page($this->module.'index', compact('child', 'notes', 'incidents'));
    }

    /*
     * add note for selected child
     * @return void
     */
    function store()
    {

        $this->load->library('form_validation');
        $this->form_validation->set_rules('title', lang('Title'), 'required|trim|xss_clean');
        $this->form_validation->set_rules('note-content', lang('Content'), 'required|trim');
        $this->form_validation->set_rules('category_id', lang('Categroy'), 'required|trim');
        $this->form_validation->set_rules('tags[]', lang('Tags'), 'required|trim');

        if($this->form_validation->run() == TRUE) {

            if($this->notes->store()) {

                flash('success', lang('request_success'));
            } else {
                flash('error', lang('request_error'));
            }

        } else {

            flash('danger');
            validation_errors();
        }
        redirect('child/'.$this->input->post('child_id').'/notes', 'refresh');
    }

    function view(){
        $note = $this->notes->getNote();
        echo json_encode($note);
    }

    /*
     * delete note
     */
    function destroy()
    {
        allow('admin,manager,staff');
        if($this->notes->destroy()) {
            flash('success', lang('request_success'));
        } else {
            flash('danger', lang('request_danger'));
        }
        redirectPrev();
    }

    function createIncident()
    {
        allow('admin,manager,staff');
        $child_id = $this->input->post('child_id');

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

        if($this->form_validation->run() == TRUE) {

            $incident_id = $this->notes->createIncident($child_id);
            dd($incident_id);
            if($incident_id) {
                flash('success', lang('request_success'));
            } else {
                flash('danger', lang('request_danger'));
            }

        } else {
            flash('danger');
            validation_errors();
            redirectPrev();
        }
        redirect('child/'.$child_id.'/notes/?viewIncident='.$incident_id, 'view-notes');
    }

    function addIncidentPhotos()
    {
        $chidID = $this->input->post('child_id');
        echo $this->photos->incident($chidID);
    }

    /*
     * delete incident
     */
    function deleteIncident()
    {
        allow('admin,manager');
        //delete incident
        if($this->notes->deleteIncident($this->uri->segment(3))) {
            flash('success', lang('request_success'));
        } else {

            flash('danger', lang('request_danger'));
        }
        redirectPrev('', 'incidents');
    }


    function deleteIncidentPhotos()
    {
        if($this->notes->deleteIncidentPhotos()) {
            echo 'success';
            return;
        }
        echo 'error';
    }
}