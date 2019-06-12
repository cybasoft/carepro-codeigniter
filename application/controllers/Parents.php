<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Parents extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        setRedirect();
        allow(['admin', 'manager', 'staff']);
        //resources
        $this->load->library('table');
        $this->load->model('My_parent', 'parent');
        $this->load->model('My_invoice', 'invoice');
        $this->title = lang('parents');
    }

    function index()
    {
        $daycare_id = $this->session->userdata('owner_daycare_id');
        $daycare_details = $this->db->get_where('daycare', array(
            'daycare_id' => $daycare_id
        ));
        $daycare = $daycare_details->row_array();
        $users = $this->db
            ->select('u.*', 'groups.name')
            ->from('users as u')
            ->where([
                'u.daycare_id'=> $daycare['id'],
                'g.name' => 'parent'
                ])
            ->join('users_groups as ug', 'ug.user_id=u.id')
            ->join('groups as g', 'g.id=ug.group_id')
            ->get()->result_array();           

        foreach ($users as $i => $user) {
            $this->db->select('c.*');
            $this->db->from('children as c');
            $this->db->where('cp.user_id', $user['id']);
            $this->db->join('child_parents as cp', 'cp.child_id=c.id', 'left');
            $users[$i]['children'] = $this->db->get()->result_array();
        }
        $this->session->unset_userdata("users");

        $groups = $this->ion_auth->groups()->result_array();
        dashboard_page('users/parents', compact('users', 'groups'), $daycare_id);
    }


    function parents()
    {
        $daycare_id = $this->session->userdata('owner_daycare_id');
        allow(['admin', 'manager', 'staff']);
        $parents = $this->parent->parents();
        $child_id = $this->uri->segment(3);
        $this->load->view('child/assign_parent', compact('parents', 'child_id', 'daycare_id'));
    }

    function invoice($term = 0)
    {
        $this->db->where('child_id', $this->child->getChildId());

        if (isset($_GET['do'])) {
            $this->db->like('id', $term);
            $query = $this->invoice->getInvoices();
        } else {
            if ($term == 0) {
                $query = $this->invoice->getInvoices();
            } else {
                $this->db->where('invoice_status', $term);
                $query = $this->invoice->getInvoices();
            }
        }
        $tmpl = array(
            'table_open' => '<table class="table table-responsive table-hover, table-stripped">',
            'heading_cell_start' => '<th class="header bg-default">',
            'heading_cell_end' => '</th>',
            'table_close' => '</table>'
        );
        $this->table->set_template($tmpl);
        $this->table->set_heading('#', lang('status'), lang('amount'), lang('paid'), lang('amount_due'), lang('due_date'), lang('actions'));
        foreach ($query as $row) {
            $preview = anchor('invoice/invoice_preview/' . $row->id, '<span class="btn btn-xs btn-info" ><i class="fa fa-print"></i></span>');

            $subTotal = $this->invoice->subTotal($row->id);
            $totalDue = number_format($subTotal - $this->invoice->amountPaid($row->id), 2);
            if ($totalDue < 0) {
                $totalDue = $totalDue . ' <span class="label label-success">' . lang('refund') . ' </span>';
                $this->invoice->updateStatus($row->id, 1); //invoice is paid
            }

            $amount_paid = $this->invoice->amountPaid($row->id) > 0 ? $this->invoice->amountPaid($row->id) : '0.00';

            $this->table->add_row(
                anchor('invoice/invoice_preview/' . $row->id, $row->id),
                $this->invoice->status($row->invoice_status),
                $this->curr . $subTotal,
                $this->curr . $amount_paid,
                '<span class="text-danger">' . $this->curr . $totalDue . '</span>',
                $row->invoice_due_date,
                $preview
            );
        }
        echo $this->table->generate();
    }
}
