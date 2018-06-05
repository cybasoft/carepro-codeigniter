<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Photos extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        setRedirect();
        allow('admin,manager,staff,parent');
        $this->module = 'modules/child/photos/';
        $this->my_child = array();
    }

    function index()
    {
        $child = $this->child->first($this->uri->segment(2));
        $this->my_child = $child;
        $photos = $this->photos();
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
                return show_404();
            }
        } else {
            page($this->module.'index', compact('child', 'photos'));
        }
    }

    function photos()
    {
        $this->load->library('pagination');
        $data = array();
        $data['results']=array();
        $limit_per_page = 50;
        $start_index = (isset($_GET['per_page']) && $_GET['per_page']>0) ? $_GET['per_page'] : 0;
        $total_records = $this->db->where('child_id', $this->my_child->id)->count_all('photos');
        if($total_records>0) {
            $this->db->limit($limit_per_page, $start_index);
            $query = $this->db->get("photos");
            if($query->num_rows()>0) {
                foreach ($query->result() as $row) {
                    $photos[] = $row;
                }
                $data["results"] = $photos;
            }
            $config['base_url'] = base_url('child/'.$this->my_child->id.'/photos');
            $config['enable_query_strings'] = true;
            $config['page_query_string'] = true;
            $config['total_rows'] = $total_records;
            $config['per_page'] = $limit_per_page;
            $config['use_page_numbers'] = TRUE;
            $config['num_links'] = 4;
            $config['full_tag_open'] = "<ul class='pagination'>";
            $config['full_tag_close'] = "</ul>";
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
            $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
            $config['next_tag_open'] = "<li>";
            $config['next_tagl_close'] = "</li>";
            $config['prev_tag_open'] = "<li>";
            $config['prev_tagl_close'] = "</li>";
            $config['first_tag_open'] = "<li>";
            $config['first_tagl_close'] = "</li>";
            $config['last_tag_open'] = "<li>";
            $config['last_tagl_close'] = "</li>";
            $this->pagination->initialize($config);
            $data["links"] = $this->pagination->create_links();
        }
        return $data;
    }

    function album()
    {

    }

    function store()
    {
        $upload_path = './assets/uploads/photos';
        if(!file_exists($upload_path)) {
            mkdir($upload_path, 755, true);
        }
        $config = array(
            'upload_path' => $upload_path,
            'allowed_types' => 'gif|jpg|png|jpeg',
            'max_size' => '3048',
            'encrypt_name' => true,
        );
        $this->load->library('upload', $config);
        if(!$this->upload->do_upload('file')) {
            $msg = lang('request_error');
            $type = 'error';
        } else {
            $upload_data = $this->upload->data();
            $this->db->insert('photos', [
                'name' => $upload_data['file_name'],
                'child_id' => $this->my_child->id,
                'uploaded_by' => $this->user->uid(),
                'caption' => '',
                'created_at' => date_stamp()
            ]);
            if($upload_data) {
                $msg = lang('request_success');
                $type = 'success';
            } else {
                $msg = lang('request_error');
                $type = 'error';
            }
        }
        echo json_encode($msg, $type);
    }

    function destroy()
    {
        $photo = $this->db->where('id', $this->input->post('id'))->get('photos')->row();
        @unlink('./assets/uploads/photos/'.$photo->name);
        if($this->db->where('id', $this->input->post('id'))->delete('photos')) {
            echo 'success';
            return;
        }
        echo 'error';
    }
}