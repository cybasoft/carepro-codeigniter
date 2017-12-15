<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @file      : dashboard.php
 * @author    : John
 * @date      : 8/9/14
 * @Copyright 2014 icoolpix.com
 */
class Dashboard extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	/*
	 * default page
	 */
	function index()
	{
		$this->load->model('My_invoice', 'invoice');
		if ($this->conf->authenticate() == true) {
			if ($this->conf->isParent() == true && $this->conf->isStaff() == false) {
				redirect('family', 'refresh');
			} else {
				$this->conf->page('dashboard/home');
			}
		} else {
			redirect('login', 'refresh');
		}
	}


	function logo()
	{
		echo '<img src="' . $this->logo2() . '"/>';
	}

	function logo2()
	{
		$image = base_url() . 'assets/img/t.jpg';
		header("Content-type: image/jpeg");
		$string = "DaycarePRO";

		$font = 66;
		$im = imagecreatefromjpeg($image);
		$x = 10;
		$y = 10;
		//$backgroundColor = imagecolorallocate ($im, 255, 255, 255);
		$textColor = imagecolorallocate($im, 40, 60, 60);
		imagestring($im, $font, $x, $y, $string, $textColor);
		imagejpeg($im);
	}

	function lockscreen()
	{
		$this->conf->authenticate();//if session has expired, logout instead
		$this->load->view('dashboard/lockscreen');
	}
	//todo suspend the previous session and create new using pin
	//todo encrypt pin
	function login()
	{
		$this->form_validation->set_rules('pin', lang('pin'), 'required|trim|xss_clean');
		if ($this->form_validation->run() == true) {
			$pin = $this->input->post('pin');

			$this->db->where('user_id', $this->user->uid());
			$this->db->where('pin', $pin);
			if ($this->db->get('user_data')->num_rows() > 0) {
				redirect('dashboard', 'refresh');
			} else {
				$this->setTimer($this->getTimer());
				$this->conf->msg('danger', 'Invalid pin!');;
			}

		} else {
			validation_errors();
			$this->conf->msg('danger');

		}
		$this->conf->redirectPrev();
	}

	//lockscreen timer
	function setTimer($time = 1)
	{
		$cookie = array(
			'name' => 'timer',
			'value' => $time,
			'expire' => '86500',
			'path' => '/',
			'secure' => TRUE
		);
		$this->input->set_cookie($cookie);

	}
	function getTimer()
	{
		$this->input->cookie('timer');
	}
}