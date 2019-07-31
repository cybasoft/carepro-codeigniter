<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @file      : news.php
 * @author    : JMuchiri
 * @Copyright 2017 A&M Digital Technologies
 */
class newsController extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        setRedirect();
        //authenticate
        auth(TRUE);
        //vars
        $this->module = 'news/';
        $this->load->model('My_user', 'user');
        $this->load->model('My_news', 'news');
        $this->title = lang('news');
    }

    function admin()
    {
        $articles = $this->news->articles();
        page($this->module.'news_admin', compact('articles'));
    }

    function index($daycare_id = NULL)
    {
        $this->load->helper('text');

        $perPage = 15;
        $page = 0;

        $this->_pagination($perPage);
        
        if(isset($_GET['page']))
            $page = $_GET['page'];

        $articles_details = $this->news->articles(
            [
                'where'=>['status','published']
            ]
        );
        $article_count = count($articles_details);
        $articles = $this->news->articles(
            [
                'limit' => [$perPage, $page],
                'where'=>['status','published']
            ]
        );
        dashboard_page($this->module.'news', compact('articles','article_count'), $daycare_id);
    }

    function create()
    {
        allow(['admin', 'manager', 'staff']);

        $this->form_validation->set_rules('list_order', lang('order'), 'required|trim|xss_clean|integer');
        $this->form_validation->set_rules('title', lang('title'), 'required|trim|xss_clean');
        $this->form_validation->set_rules('content', lang('content'), 'required|trim|xss_clean');
        $this->form_validation->set_rules('publish_date', lang('Date'), 'required|trim|xss_clean');

        if($this->form_validation->run() == TRUE) {
            if($this->news->create()) {
                flash('success', lang('request_success'));
            } else {
                flash('danger', lang('request_error'));
            }
            redirect('news', 'refresh');
        } else {
            $categories = $this->news->categories();
            page($this->module.'new_article', compact('categories')); //load editor
        }
    }

    /*
     * load single article
     */
    function article()
    {
        $id = $this->uri->segment(3);
        $article = $this->news->article($id);
        if($article == NULL) {
            flash('success', lang('Page not found'));
            redirect('news');
        }

        $articles = $this->news->articles(['limit' => 10]);

        page($this->module.'article', compact('article', 'articles'));
    }

    /*
     * load editor
     */
    function edit()
    {
        allow(['admin', 'manager', 'staff']);

        $id = $this->uri->segment(3);

        $article = $this->news->article($id);

        if(empty((array)$article)) show_404();

        $categories = $this->news->categories();
        page($this->module.'edit_article', compact('article', 'categories'));
    }

    function update()
    {
        allow(['admin', 'manager', 'staff']);

        $id = $this->uri->segment(3);

        $this->form_validation->set_rules('list_order', lang('order'), 'required|trim|xss_clean|integer');
        $this->form_validation->set_rules('title', lang('title'), 'required|trim|xss_clean');
        $this->form_validation->set_rules('content', lang('content'), 'required|trim|xss_clean');
        if($this->form_validation->run() == TRUE) {
            if($this->news->update($id) == TRUE) {
                flash('success', lang('request_success'));
            } else {
                flash('warning', 'request_error');
            }
        } else {
            set_flash(['list_order', 'title', 'content', 'category']);
            validation_errors();
            flash('danger');
        }
        redirect('news/edit/'.$id);
    }

    /*
     * delete article
     */
    function delete()
    {
        allow(['admin', 'manager']);
        $id = $this->uri->segment(3);

        if($this->news->delete($id) == TRUE) { //successful
            flash('success', lang('request_success'));
        } else {
            flash('danger', lang('request_error'));
        }

        redirect('news/admin');
    }

    function _pagination($perPage)
    {
        $this->load->library('pagination');

        $config['base_url'] = site_url('news');
        $config['total_rows'] = $this->news->count('published');
        $config['per_page'] = $perPage;        
        $config['reuse_query_string'] = TRUE;
    //    $config['enable_query_strings'] = false;
        $config['page_query_string'] = TRUE;
        $config['query_string_segment'] = 'page';

        $config['full_tag_open'] = "<ul class='pagination'>";
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';

        $config['prev_link'] = '<i class="fa fa-arrow-left"></i>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';

        $config['next_link'] = '<i class="fa fa-arrow-right"></i>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';

        $this->pagination->initialize($config);
    }
}