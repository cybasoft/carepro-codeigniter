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
        //redirect session
        setRedirect();
        auth(true);
        $this->load->model('My_child', 'child');
        $this->load->model('My_health', 'health');
        $this->module = 'child/health/';
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

            if($this->health->addMedicationToChild()) {
                flash('success', lang('request_success'));
            } else {
                flash('danger', lang('request_error'));
            }

        } else {
            validation_errors();
            flash('error');
        }
        redirectPrev(null, 'meds');
    }

    /*
     * delete medication
     * @return void
     */
    function destroy()
    {
        allow(['admin','manager','staff']);

        if($this->health->deleteMedication($this->uri->segment(3))) {
            flash('success', lang('request_success'));
        } else {
            flash('danger', lang('request_error'));
        }
        //go back
        redirectPrev(null, 'meds');
    }

    function uploadMedPhoto()
    {
        $this->form_validation->set_rules('med_name', lang('Medication name'), 'required|trim|xss_clean');
        if($this->form_validation->run() == true) {
            if($this->health->uploadMedPhoto($this->input->post('med_name')))
                flash('success', lang('request_success'));
        } else {
            validation_errors();
            flash('error');
        }

        redirectPrev();
    }

    function deleteMedicationPhoto()
    {
        if($this->health->deleteMedicationPhoto($this->uri->segment(3)))
            flash('success', lang('request_success'));

        redirectPrev(null, 'meds');
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
        if($this->form_validation->run() == true) {
            if($this->health->administerMed()) {
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

        $this->load->library('table');

        if(is('parent'))
            $this->db->where('staff_only !=', 1);
        $this->db->where('med_id', $this->uri->segment(3));
        $results = $this->db->get('meds_admin')->result();

        $data = array();

        foreach ($results as $result) {

            $data[] = [
                'date' => date('d/M/Y', strtotime($result->given_at)),
                'time' => date('h:ia', strtotime($result->given_at)),
                'staff' => $this->user->get($result->user_id, ['name']),
                'remarks' => ($result->staff_only == 1) ? '<span class="label label-default">'.lang('Staff only').'</span>' : ''
                    .$result->remarks,
                'actions' => !is('parent')?anchor('meds/deleteHistory/'.$result->id, '<i class="fa fa-trash text-danger"></i>', 'class="delete"'):''
            ];
        }

        $med = $this->db->where('id', $this->uri->segment(3))->get('child_meds')->row();

        $this->table->add_row(
            [
                'colspan' => 2,
                'data' => '<h3 class="text-danger">'.$med->med_name.'</h3>'
            ],
            [
                'colspan' => 3,
                'data' => '<h4 class="text-warning">'.$med->med_notes.'</h4>'
            ]
        );

        $this->table->set_heading(
            [
                lang('Date'),
                lang('Time'),
                lang('Staff'),
                lang('Remarks'),
                ''
            ]
        );

        $this->table->set_template(
            [
                'table_open' => '<table class="table table-striped">'
            ]
        );

        echo $this->table->generate($data);

    }

    function deleteHistory()
    {
        allow(['admin','manager','staff']);

        $this->db->where('id', $this->uri->segment(3))->delete('meds_admin');

        if($this->db->affected_rows() > 0)
            flash('success', lang('request_success'));
        else
            flash('error', lang('request_error'));

        redirectPrev('', 'meds');

    }
}

?>