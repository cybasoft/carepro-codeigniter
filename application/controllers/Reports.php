<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Reports extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        //redirect session
        setRedirect();
        allow(['admin', 'manager']);
        //variables
        $this->load->model('My_reports', 'reports');
        $this->module = 'reports/';
        $this->title = lang('reports');
    }

    public function index()
    {

    }

    function roster()
    {
        $logged_user_id = $this->user->uid();
        if(isset($_GET['active'])) { //daily attendance
            $this->db->where('status', 1)->where('user_id',$logged_user_id);
            $children = $this->db->get('children')->result();
            $this->load->view($this->module.'roster', compact('children'));
        } else {            
            if(isset($_GET['group']) && $_GET['group'] > 0) {              
                $this->db->select('*');
                $this->db->where('child_group.group_id', $_GET['group']);
                $this->db->from('children')->where('user_id',$logged_user_id);
                $this->db->join('child_group', 'child_group.child_id=children.id', 'left');
                $children = $this->db->get()->result();               
            } else {
                if(isset($_GET['inactive'])) {
                    $this->db->where('status', 0)->where('user_id',$logged_user_id);
                }            
                $this->db->where('user_id',$logged_user_id);
                $children = $this->db->get('children')->result();
            }            
            $this->load->view($this->module.'roster', compact('children'));
        }
    }

    function reportForm()
    {
        $this->load->view($this->module.'report-form-popover');
    }

    function attendance()
    {
        if(isset($_POST['date'])) {
            $this->load->view('child/reports/attendance_meals');
        }else{
            $this->load->view('child/reports/attendance_date');
        }
    }
}

