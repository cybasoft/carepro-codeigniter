<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @file      : news.php
 * @author    : John
 * @date      : 8/9/14
 * @Copyright 2014 icoolpix.com
 */
class news extends CI_Controller
{

	function __construct()
	{
		parent::__construct();

		$this->conf->setRedirect();

		//authenticate
		$this->conf->authenticate();

		//vars
		$this->module = 'modules/news/';

		$this->load->model('My_user', 'user');
		$this->load->model('My_news', 'news');

	}

	function index()
	{
		$this->load->helper('text');
		$data = array(
			'articles' => $this->news->articles()
		);
		$this->conf->page($this->module . 'index', $data);
	}

	function create()
	{
		$this->conf->allow('admin,manager,staff');

		$this->form_validation->set_rules('article_order', 'order', 'required|trim|xss_clean|integer');
		$this->form_validation->set_rules('article_name', 'File name', 'required|trim|xss_clean');
		$this->form_validation->set_rules('article_body', 'Article body', 'required|trim|xss_clean');

		if ($this->form_validation->run() == TRUE) {
			if ($this->news->create()) {
				$this->conf->msg('success', lang('request_success'));
			} else {
				$this->conf->msg('danger', lang('request_error'));
			}
			redirect('news', 'refresh');

		} else {
			$this->conf->page($this->module . 'new_article'); //load editor
		}
	}

	/*
	 * load single article
	 */
	function view($id)
	{
		$data['article'] = $this->news->article($id)->row();
		$this->conf->page($this->module . 'view_article', $data);
	}

	/*
	 * create and edit new article
	 */
	function editor($article = 0)
	{
		$this->conf->allow('admin,manager,staff');
		$this->conf->belongsTo($article, 'news');

		if ($article >= 0 && is_numeric($article)) {
			$this->session->set_userdata('news_article_id', $article);
			redirect('news/edit');
		}

		redirect('news', 'refresh');
	}

	/*
	 * load editor
	 */
	function edit()
	{
		$this->conf->allow('admin,manager,staff');

		$article = $this->session->userdata('news_article_id');
		if ($article <= 0 && !is_numeric($article)) { //double check an article has been selected
			redirect('news/edit', 'refresh');
		}
		//edit and update
		$this->form_validation->set_rules('article_order', 'order', 'required|trim|xss_clean|integer');
		$this->form_validation->set_rules('article_name', 'File name', 'required|trim|xss_clean');
		$this->form_validation->set_rules('article_body', 'Article body', 'required|trim|xss_clean');

		if ($this->form_validation->run() == TRUE) {
			if ($this->news->update($article) == true) {
				$this->conf->msg('success', lang('request_success'));
			} else {
				$this->conf->msg('warning', 'request_error');
			}
			redirect('news/edit');
		} else {
			$data['articles'] = $this->news->articles();
			$data['article'] = $this->news->article($article)->row();
			$this->conf->page($this->module . 'edit_article', $data); //load editor
		}
	}

	/*
	 * delete article
	 */
	function delete($id)
	{
		$this->conf->allow('admin,manager');

		$this->conf->belongsTo($id, 'news');

		if ($this->news->delete($id) == true) { //successful
			$this->conf->msg('success', lang('request_success'));
			redirect('news', 'refresh');
		} else {
			$this->conf->msg('danger', lang('request_error'));
			$this->conf->redirectPrev();
		}

	}


}