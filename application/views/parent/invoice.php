<div class="row">
    <div class="col-md-12">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs no-print">
                <li class="<?php if(!isset($_GET['view'])) {
                    echo 'active';
                } ?>"><a href="#1-1" data-toggle="tab"><?php echo lang('invoice'); ?></a></li>
                <?php if(isset($_GET['view'])): ?>
                    <li class="active"><a href="#1-x"
                                          data-toggle="tab"><?php echo lang('invoice').'# '.$_GET['view']; ?></a></li>
                <?php endif; ?>
                <li><a href="#1-2" data-toggle="tab"><?php echo lang('overdue'); ?></a></li>
                <li><a href="#1-3" data-toggle="tab"><?php echo lang('payment_history'); ?></a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane <?php if(!isset($_GET['view'])) {
                    echo 'active';
                } ?>" id="1-1">
                    <div class="card">
                        <div class="card-body">
                            <?php
                            if(isset($_GET['status'])):
                                $status = $_GET['status'];
                                if($status == "paid" || $status == "due" || $status == "cancelled") {
                                    switch ($status) {
                                        case "paid":
                                            $s = 1;
                                            break;
                                        case "due":
                                            $s = 2;
                                            break;
                                        case "cancelled":
                                            $s = 0;
                                            break;
                                    }
                                    $this->db->where('invoice_status', $s);
                                }
                            endif;

                            if(isset($_GET['search'])) {
                                $this->db->like('id', $_GET['search']);
                            }
                            $this->db->where('child_id', $this->child->getID());
                            $query = $this->invoice->getInvoices();
                            ?>
                            <table class="table table-stripped ">
                                <thead>
                                <tr>
                                    <td>#</td>
                                    <td><?php echo lang('status'); ?></td>
                                    <td><?php echo lang('amount'); ?></td>
                                    <td><?php echo lang('paid'); ?></td>
                                    <td><?php echo lang('due'); ?></td>
                                    <td><?php echo lang('due_date'); ?></td>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                foreach ($query as $row):

                                    $subTotal = $this->invoice->subTotal($row->id);
                                    $totalDue = $subTotal - $this->invoice->amountPaid($row->id);
                                    if($totalDue < 0) {
                                        $totalDue = $totalDue.' <span class="label label-success">'.lang('refund').' </span>';
                                    }
                                    ?>
                                    <tr>
                                        <td><?php echo anchor(uri_string().'?p=invoice&view='.$row->id, $row->id); ?></td>
                                        <td><?php echo $this->invoice->invoice_status($row->invoice_status); ?></td>
                                        <td>x<?php echo $subTotal; ?></td>
                                        <td><?php echo $this->invoice->amountPaid($row->id); ?></td>
                                        <td><span
                                                    class="text-danger"><?php echo $totalDue; ?></span>
                                        </td>
                                        <td><?php echo strtoupper(date('d-M-y', strtotime($row->invoice_due_date))); ?></td>
                                        <td><?php echo anchor(uri_string().'?p=invoice&view='.$row->id, '<span class="btn btn-xs btn-info" ><i class="glyphicon glyphicon-eye-open"></i></span>'); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="1-2">
                    <div class="card">
                        <div class="card-body">

                        </div>
                    </div>
                </div>
                <div class="tab-pane <?php if(isset($_GET['view'])) {
                    echo 'active';
                } ?>" id="1-x">
                    <div class="card">
                        <div class="card-body">
                            <div style="font-family: courier, monospace">
                                <div class="row">
                                    <div class="col-sm-4 invoice-col">
                                        <div class="card">
                                            <div class="card-header bg-light-blue">
                                            </div>
                                            <div class="card-body">
                                                <?php echo $this->company->logo(); ?>
                                                <?php
                                                $this->db->where('id', $_GET['view']);
                                                $invoice = $this->db->get('accnt_invoices')->row();
                                                echo $this->conf->company()->street;
                                                echo br();
                                                echo $this->conf->company()->city.'. ';
                                                echo $this->conf->company()->state.' ,';
                                                echo $this->conf->company()->zip;
                                                echo br();
                                                echo $this->conf->company()->phone;
                                                echo br();
                                                echo $this->conf->company()->email;
                                                echo br();
                                                echo $this->conf->company()->website;
                                                ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4 invoice-col">
                                        <div style="width:150px; left:50%;">
                                            <?php echo $this->invoice->stamp($invoice->id); ?>
                                        </div>
                                    </div>

                                    <div class="col-sm-4 invoice-col">
                                        <table class="table">
                                            <tr>
                                                <td><?php echo lang('invoice'); ?>#:</td>
                                                <td> <?php echo $invoice->id; ?></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo lang('child'); ?>:</td>
                                                <td><?php echo $this->children->child($invoice->child_id)->fname.' '.$this->children->child($invoice->child_id)->lname; ?></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo lang('date'); ?>:</td>
                                                <td><?php echo strtoupper(date('d-M-y', strtotime($invoice->invoice_date))); ?></td>
                                            </tr>
                                            <tr>
                                                <td><?php echo lang('due'); ?>:</td>
                                                <td><?php echo strtoupper(date('d-M-y', strtotime($invoice->invoice_due_date))); ?></td>
                                            </tr>
                                        </table>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-sm-12 col-md-12 col-lg-12">

                                        <table id="item_table" class="table table-bordered">
                                            <thead>
                                            <tr class="table_header">
                                                <th><?php echo lang('item'); ?></th>
                                                <th><?php echo lang('description'); ?></th>
                                                <th><?php echo lang('quantity'); ?></i></th>
                                                <th class="text-right"><?php echo lang('amount'); ?></th>
                                                <th class="text-right"><?php echo lang('discount'); ?></th>
                                                <th class="text-right"><?php echo lang('sub_total'); ?></th>

                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $subTotal = 0;
                                            $totalTax = 0;
                                            $totalDiscount = 0;
                                            $this->db->where('invoice_id', $_GET['view']);
                                            $invoice_items = $this->db->get('accnt_invoice_items')->result();
                                            foreach ($invoice_items as $item) {
                                                ?>
                                                <tr id="new_item">
                                                    <td style="width:20%"><?php echo $item->item_name; ?></td>
                                                    <td><?php echo $item->item_description; ?></td>
                                                    <td style="width:5%"><?php echo $item->item_quantity; ?></td>
                                                    <td class="text-right"
                                                        style="width:10%"><?php echo $item->item_price; ?></td>
                                                    <td class="text-right"
                                                        style="width:10%"><?php echo $item->item_discount; ?></td>
                                                    <td class="text-right" style="width:10%">
                                                        <?php echo(($item->item_quantity * $item->item_price) - $item->item_discount); ?>
                                                    </td>
                                                </tr>
                                                <?php
                                                $subTotal = $this->invoice->subTotal($invoice->id);
                                                $totalDiscount = $item->item_discount + $totalDiscount;
                                            }
                                            ?>


                                            <tr class="text-info">
                                                <td colspan="3" rowspan="5" class="text-info">
                                                    <h4><?php echo lang('invoice_terms'); ?></h4>

                                                    <div class="text-muted well well-sm no-shadow"><?php echo $invoice->invoice_terms; ?></div>
                                                </td>
                                                <td colspan="3" class="no-border">
                                                    <table class="table table-bordered">
                                                        <tr class="text-right text-info">
                                                            <td class="text-right">
                                                                <?php echo lang('discounts'); ?>
                                                            </td>
                                                            <td style="vertical-align: middle; width:130px">
                                                                <?php echo $totalDiscount; ?>
                                                            </td>
                                                        </tr>
                                                        <tr class="text-right">
                                                            <td> <?php echo lang('sub_total'); ?> :</td>
                                                            <td><?php echo $subTotal; ?></td>
                                                        </tr>
                                                        <tr class="text-right text-success">
                                                            <td class="text-right"><?php echo lang('amount_paid'); ?>
                                                                :
                                                            </td>
                                                            <td>
                                                                $ <?php
                                                                $totalPaid = $this->invoice->amountPaid($invoice->id);
                                                                echo($totalPaid > 0 ? $totalPaid : "0.00"); ?>
                                                            </td>
                                                        </tr>
                                                        <tr class="text-right text-danger">
                                                            <td> <?php echo lang('amount_due'); ?> :</td>
                                                            <td>
                                                                <?php
                                                                $totalDue = $this->invoice->amountDue($invoice->id);
                                                                if($totalDue > 0) {
                                                                    echo $totalDue;
                                                                } else {
                                                                    echo '<span class="label label-success">'.lang('refund').'</span> '.$totalDue;
                                                                }
                                                                ?>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>


                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <div class="btn-group">
                                        <?php if($totalDue > 0): ?>
                                            <a target="_blank" id="paypal-btn"
                                               href="<?php echo $this->invoice->paypal($invoice->id, 'daycarePP'); ?>"
                                               class="btn btn-primary">
                                                <span class="glyphicon glyphicon-credit-card"></span>
                                                PayPal
                                            </a>
                                        <?php endif; ?>
                                        <button class="btn btn-info" onclick="window.print();">
                                            <span class="glyphicon glyphicon-print"></span>
                                            <?php echo lang('print'); ?>
                                        </button>

                                        <?php echo anchor(uri_string().'?p=invoice',
                                            '<i class="fa fa-times"></i> '.lang('close'),
                                            'class="btn btn-danger"'); ?>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="1-3">
                    <div class="card">
                        <div class="card-body">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>