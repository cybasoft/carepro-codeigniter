<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Photos extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        auth(true);

        $this->module = 'modules/child/photos/';
        $this->my_child = array();
        $this->load->model('My_photos', 'photos');
        $this->title = lang('child').'-'.lang('photos');
    }

    function index()
    {
        $child = $this->child->first($this->uri->segment(2));

        if(!authorizedToChild($this->user->uid(), $child->id)) {
            flash('error', lang('You do not have permission to view this child\'s profile'));
            redirectPrev();
        }

        $this->my_child = $child;
        $photos = $this->photos->albums('photos', $child->id, 'album');
        $method = $this->uri->segment(4);
        $param = $this->uri->segment(5);

        if($method !== null) {
            if(method_exists($this, $method)) {
                if($param == null) {
                    $this->$method();
                } else {
                    $this->$method($param);
                }
            } else {
                show_404();
            }
        } else {
            page($this->module.'index', compact('child', 'photos'));
        }
    }

    function store()
    {
        if(is('parent')) {
            echo 'Error';
            return;
        }
        echo $this->photos->store('album');
    }

    function destroy()
    {
        allow(['admin','manager','staff']);

        $photo = $this->db->where('id', $this->input->post('id'))->get('photos')->row();

        @unlink('./assets/uploads/photos/'.$photo->name);
        if($this->db->where('id', $this->input->post('id'))->delete('photos')) {
            echo 'success';
            return;
        }
        echo 'error';
    }
}