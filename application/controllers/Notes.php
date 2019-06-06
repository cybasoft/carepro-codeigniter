<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class notes extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        auth(true);
        //local variables
        $this->module = 'child/notes/';
        $this->load->helper('text');
        $this->load->model('My_photos', 'photos');
        $this->load->model('My_notes', 'notes');
        $this->title = lang('child').'-'.lang('notes');
    }

    function index($daycare_id,$id)
    {        
        if(!authorizedToChild(user_id(), $id)) {
            flash('error', lang('You do not have permission to view this child\'s profile'));
            redirectPrev();
        }


        $child = $this->db->where('id',$id)->get('children')->row();
        if(empty($child)) {
            flash('error', lang('request_error'));
            redirect($daycare_id.'/dashboard', 'refresh');
        }

        $child->notes = $this->db
            ->where('cn.child_id',$id)
            ->select("cn.*,nc.name as category,CONCAT(u.first_name,' ',u.last_name) as user_name")
            ->from('child_notes AS cn')
            ->join('notes_categories AS nc','nc.id=cn.category_id')
            ->join('users AS u','u.id=cn.user_id')
            ->get()->result();

        $child->incidents = $this->db
            ->where('ci.child_id',$id)
            ->select("ci.*,CONCAT(u.first_name,' ',u.last_name) as user_name")
            ->from('child_incident AS ci')
            ->join('users AS u','u.id=ci.user_id')
            ->get()->result();

        page($this->module.'notes', compact('child','daycare_id'));
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
            set_flash(['title', 'note-content']);

            flash('danger');
            validation_errors();
        }

        redirectPrev();
    }

    function view()
    {
        $note = $this->notes->getNote();
        echo json_encode($note);
    }

    /*
     * delete note
     */
    function destroy()
    {
        allow(['admin', 'manager', 'staff']);
        if($this->notes->destroy()) {
            flash('success', lang('request_success'));
        } else {
            flash('danger', lang('request_danger'));
        }
        redirectPrev();
    }

    function createIncident()
    {
        allow(['admin', 'manager', 'staff']);
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

            if($incident_id) {
                flash('success', lang('request_success'));
            } else {
                flash('danger', lang('request_error'));
            }

        } else {
            set_flash([
                'title',
                'location',
                'incident_type',
                'description',
                'actions_taken',
                'witnesses',
                'remarks',
                'date',
                'time'
            ]);
            flash('danger');
            validation_errors();
            redirectPrev();
        }
        redirect('child/'.$child_id.'/notes/?viewIncident='.$incident_id.'#view-notes');
    }

    function storeIncidentPhotos()
    {
        if(is('parent')) {
            echo 'Error';
            return;
        }

        $chidID = $this->input->post('child_id');
        echo $this->notes->storeIncidentPhotos($chidID);
    }

    /*
     * delete incident
     */
    function deleteIncident()
    {
        allow(['admin', 'manager']);
        //delete incident
        if($this->notes->deleteIncident($this->uri->segment(3))) {
            flash('success', lang('request_success'));
        } else {

            flash('danger', lang('request_danger'));
        }
        redirectPrev('', 'incidents');
    }


    function deleteIncidentPhoto()
    {
        allow(['admin', 'manager', 'staff']);

        if($this->notes->deleteIncidentPhoto()) {
            echo 'success';
            return;
        }
        echo 'error';
    }

    function storeCategory()
    {
        allow(['admin', 'manager']);

        $this->form_validation->set_rules('name', lang('Name'), 'required|xss_clean|trim');
        if($this->form_validation->run() == true) {
            $this->db->insert('notes_categories', ['name' => $this->input->post('name')]);
            if($this->db->affected_rows() > 0) {
                flash('success', lang('request_success'));
            } else {
                flash('error', lang('request_error'));
            }
        } else {
            validation_errors();
            flash('error');
        }
        redirectPrev('', 'note-categories');
    }

    function destroyCategory()
    {
        allow(['admin', 'manager']);

        $this->db->where('id', $this->uri->segment(3))->delete('notes_categories');
        flash('success', lang('request_success'));
        redirectPrev('', 'note-categories');
    }

    function storeTag()
    {
        allow(['admin', 'manager']);

        $this->form_validation->set_rules('name', lang('Name'), 'required|xss_clean|trim');
        if($this->form_validation->run() == true) {
            $this->db->insert('notes_tags', ['name' => $this->input->post('name')]);
            if($this->db->affected_rows() > 0) {
                flash('success', lang('request_success'));
            } else {
                flash('error', lang('request_error'));
            }
        } else {
            validation_errors();
            flash('error');
        }
        redirectPrev('', 'note-categories');
    }

    function destroyTag()
    {
        allow(['admin', 'manager']);

        $this->db->where('id', $this->uri->segment(3))->delete('notes_tags');
        flash('success', lang('request_success'));
        redirectPrev('', 'note-categories');
    }
}