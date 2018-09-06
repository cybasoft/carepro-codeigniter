<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @file      : child.php
 * @author    : JMuchiri
 * @Copyright 2017 A&M Digital Technologies
 */
class Food extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->module = 'modules/child/';
        $this->title = lang('food');
        $this->load->model('My_food', 'food');
    }

    /*
    * add food pref
    */
    function newPref()
    {
        $this->form_validation->set_rules('food', lang('food'), 'required|trim|xss_clean');
        $this->form_validation->set_rules('food_time', lang('time'), 'required|trim|xss_clean');
        $this->form_validation->set_rules('comment', lang('comment'), 'trim|xss_clean');

        if($this->form_validation->run() == TRUE) {

            if($this->food->newPref()) {
                flash('success', lang('request_success'));
            } else {
                flash('danger', lang('request_error'));
            }
        } else {
            flash('danger');
            validation_errors();
        }
        redirectPrev(null, 'food');

    }


    /*
     * delete food pref
     */
    function deletePref()
    {
        $id = $this->uri->segment(3);

        if($id !== "" & is_numeric($id)) {
            //make sure its the parent authorized or admin
            $childID = $this->db->where('id', $id)->get('child_foodpref')->row();
            if(is(['staff', 'admin','manager']) || $this->child->belongsTo($this->user->uid(), $childID->child_id)) {
                if($this->db->where('id', $id)->delete('child_foodpref')) {
                    flash('success', lang('request_success'));
                } else {
                    flash('danger', lang('request_error'));
                }
            } else {
                flash('danger', lang('record_not_found'));
            }

        }
        redirectPrev(null, 'food');
    }

    function recordIntake()
    {
        $this->form_validation->set_rules('date', lang('Date'), 'required|xss_clean|trim');
        $this->form_validation->set_rules('time', lang('Time'), 'required|xss_clean|trim');
        $this->form_validation->set_rules('meal_time', lang('Meal time'), 'required|xss_clean|trim');
        $this->form_validation->set_rules('quantity', lang('Quantity'), 'required|xss_clean|trim');
        $this->form_validation->set_rules('comment', lang('Comment'), 'xss_clean|trim');
        if($this->form_validation->run() == true) {
            if($this->food->recordIntake())
                flash('success', lang('Food intake recorded'));
            else
                flash('error', lang('request_error'));
        } else {
            validation_errors();
            flash('error');
        }
        redirectPrev('', 'food');
    }


    function deleteIntake(){
        allow(['admin','manager','staff']);

        $id = $this->uri->segment(3);

        if($this->db->where('id',$id)->delete('child_food_intake')){
            flash('success',lang('request_success'));
        }else{
            flash('error',lang('request_error'));
        }

        redirectPrev('','food');
    }
}