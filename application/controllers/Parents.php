<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Parents extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		setRedirect();
		allow(['admin','manager','staff']);
		//resources
		$this->load->library('table');
		$this->load->model('My_parent', 'parent');
		$this->load->model('My_invoice', 'invoice');
        $this->title = lang('parents');
	}
	function index(){
	    $users = $this->db
            ->where('groups.name','parent')
            ->from('users')
            ->join('users_groups','users_groups.user_id=users.id')
            ->join('groups','groups.id=users_groups.group_id')
            ->get()->result();
        $groups=$this->ion_auth->groups()->result_array();
	    page('modules/users/parents',compact('users','groups'));
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