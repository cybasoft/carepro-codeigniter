<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @file      : news.php
 * @author    : JMuchiri
 * @Copyright 2017 A&M Digital Technologies
 */
class news extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        setRedirect();
        //authenticate
        auth(true);
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
        page($this->module . 'index', $data);
    }

    function create()
    {
        allow('admin,manager,staff');

        $this->form_validation->set_rules('article_order', lang('order'), 'required|trim|xss_clean|integer');
        $this->form_validation->set_rules('article_name', lang('title'), 'required|trim|xss_clean');
        $this->form_validation->set_rules('article_body', lang('content'), 'required|trim|xss_clean');

        if ($this->form_validation->run() == TRUE) {
            if ($this->news->create()) {
                flash('success', lang('request_success'));
            } else {
                flash('danger', lang('request_error'));
            }
            redirect('news', 'refresh');
        } else {
            page($this->module . 'new_article'); //load editor
        }
    }

    /*
     * load single article
     */
    function view($id)
    {
        $data['article'] = $this->news->article($id)->row();
        page($this->module . 'view_article', $data);
    }

    /*
     * create and edit new article
     */
    function editor($article = 0)
    {
        allow('admin,manager,staff');
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
        allow('admin,manager,staff');
        $article = $this->session->userdata('news_article_id');
        if ($article <= 0 && !is_numeric($article)) { //double check an article has been selected
            redirect('news/edit', 'refresh');
        }
        //edit and update
        $this->form_validation->set_rules('article_order', lang('order'), 'required|trim|xss_clean|integer');
        $this->form_validation->set_rules('article_name', lang('title'), 'required|trim|xss_clean');
        $this->form_validation->set_rules('article_body', lang('content'), 'required|trim|xss_clean');
        if ($this->form_validation->run() == TRUE) {
            if ($this->news->update($article) == true) {
                flash('success', lang('request_success'));
            } else {
                flash('warning', 'request_error');
            }
            redirect('news/edit');
        } else {
            $data['articles'] = $this->news->articles();
            $data['article'] = $this->news->article($article)->row();
            page($this->module . 'edit_article', $data); //load editor
        }
    }

    /*
     * delete article
     */
    function delete($id)
    {
        allow('admin,manager');
        if ($this->news->delete($id) == true) { //successful
            flash('success', lang('request_success'));
            redirect('news', 'refresh');
        } else {
            flash('danger', lang('request_error'));
            redirectPrev();
        }

    }


}