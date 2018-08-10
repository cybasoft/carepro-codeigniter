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


}