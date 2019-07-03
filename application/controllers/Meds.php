<?php

if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @package     daycarepro app
 * @copyright   2018 A&M Digital Technologies
 * @author      John Muchiri
 * @link        https://amdtllc.com
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */
class Meds extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        setRedirect();

        auth(TRUE);

        $this->module = 'child/health/';

        $this->load->model('My_meds', 'meds');

        $this->title = lang('child').'-'.lang('health');
    }

    /*
     * add medication
     * @return void
     */
    function addMedicationToChild()
    {
        $this->form_validation->set_rules('med_name', lang('medication'), 'required|trim|xss_clean');
        if($this->form_validation->run() == TRUE) {

            if($this->meds->addMedicationToChild()) {
                flash('success', lang('request_success'));
            } else {
                flash('danger', lang('request_error'));
            }

        } else {
            validation_errors();
            flash('error');
        }
        redirectPrev(NULL, 'meds');
    }

    /*
     * delete medication
     * @return void
     */
    function destroy()
    {
        allow(['admin', 'manager', 'staff']);

        if($this->meds->deleteMedication($this->uri->segment(3))) {
            logEvent($user_id = NULL,"Deleted Med ID: {$this->uri->segment(3)} for child ID: {$this->uri->segment(3)}",$care_id = NULL);
            flash('success', lang('request_success'));
        } else {
            flash('danger', lang('request_error'));
        }
        //go back
        redirectPrev(NULL, 'meds');
    }

    function uploadMedPhoto()
    {
        $this->form_validation->set_rules('med_name', lang('Medication name'), 'required|trim|xss_clean');
        if($this->form_validation->run() == TRUE) {
            if($this->meds->uploadMedPhoto($this->input->post('med_name')))
                flash('success', lang('request_success'));
        } else {
            validation_errors();
            flash('error');
        }

        redirectPrev();
    }

    function deleteMedicationPhoto()
    {
        if($this->meds->deleteMedicationPhoto($this->uri->segment(3)))
            flash('success', lang('request_success'));

        redirectPrev(NULL, 'meds');
    }

    function medModal()
    {
        $childID = 1;
        $this->load->view($this->module.'meds/med_admin_modal', compact('childID'));
    }

    function administer()
    {
        $this->form_validation->set_rules('date', lang('Date'), 'required|xss_clean|trim');
        $this->form_validation->set_rules('time', lang('Time'), 'required|xss_clean|trim');
        if($this->form_validation->run() == TRUE) {
            if($this->meds->administerMed()) {
                flash('success', lang('Record added'));
            } else {
                flash('error', lang('request_error'));
            }
        } else {
            validation_errors();
            flash('error');
        }

        redirectPrev('', 'meds');
    }

    /**
     * generate table for med admin history
     */
    function history()
    {
        if(!$this->input->is_ajax_request())
            exit('No direct script access allowed');

        $medHistory = $this->meds->history($this->uri->segment(3));
        $med = $this->db
            ->select("child_meds.*,CONCAT(children.first_name,' ',children.last_name) as child_name")
            ->where('child_meds.id', $this->uri->segment(3))
            ->from('child_meds')
            ->join('children', 'children.id=child_meds.child_id')
            ->get()->row();

        $this->load->view($this->module.'meds/med_history_modal', compact('medHistory', 'med'));
    }

    /**
     * @param $id
     *
     * @return false|string
     */
    function deleteHistory()
    {
        allow(['admin', 'manager', 'staff']);

        $res = $this->meds->deleteHistory($this->uri->segment(3));

        if($res > 0)
            echo json_encode(['message' => lang('request_success')]);
        else
            echo json_encode(['messages' => lang('request_error')]);
    }

    function medImages(){
        allow(['admin', 'manager', 'staff','parent']);
        $medImages = $this->db->get('med_photos')->result();
        $this->load->view($this->module.'meds/med_images_modal',compact('medImages'));
    }
    function newMedModal(){
        allow(['admin', 'manager', 'staff','parent']);
        $medImages = $this->db->get('med_photos')->result();
        $this->load->view($this->module.'meds/create_med_modal',compact('medImages'));
    }
}

?>