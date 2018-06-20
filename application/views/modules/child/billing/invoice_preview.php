<!DOCTYPE html>
<html moznomarginboxes mozdisallowselectionprint>
<head>
    <meta charset="UTF-8">
    <title><?php echo get_option('company_name'); ?></title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url(); ?>assets/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    <style>
        .container {
            width: 1170px;
            margin: 0 auto;
        }

        @media print {
            @page {
                margin: 0;
            }

            body {
                margin: 1.6cm;
            }
        }
    </style>
    <script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>
</head>
<body onload="javascript:print()">
<div class="container" style="font-family: courier, monospace">
    <div class="row">
        <div class="col-sm-4 invoice-col">
            <div class="box box-solid">
                <div class="box-header bg-light-blue">
                </div>
                <div class="box-body">
                    <img src="<?php echo base_url(); ?>assets/img/<?php echo get_option('invoice_logo'); ?>"/>
                    <br/>
                    <?php
                    echo get_option('street').'<br/>';
                    echo get_option('street2');
                    echo "<br/>";
                    echo get_option('city').'. ';
                    echo get_option('state').' ,';
                    echo get_option('postal_code');
                    echo "<br/>";
                    echo get_option('phone');
                    echo "<br/>";
                    echo get_option('email');
                    ?>
                </div>
            </div>
        </div>

        <div class="col-sm-4 invoice-col">
            <div style="width:150px; left:50%;">
                <?php echo $this->invoice->stamp($invoice->invoice_status); ?>
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
                    <td><?php echo $this->child->child($invoice->child_id)->first_name.' '.$this->child->child($invoice->child_id)->last_name; ?></td>
                </tr>
                <tr>
                    <td><?php echo lang('date'); ?>:</td>
                    <td><?php echo format_date($invoice->created_at); ?></td>
                </tr>
                <tr>
                    <td><?php echo lang('due'); ?>:</td>
                    <td><?php echo format_date($invoice->date_due); ?></td>
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
                    <th class="text-right"><?php echo lang('sub_total'); ?></th>

                </tr>
                </thead>
                <tbody>
                <?php
                $subTotal = 0;
                $totalTax = 0;
                foreach ($invoice_items as $item) {
                    ?>
                    <tr id="new_item">
                        <td style="width:20%"><?php echo $item->item_name; ?></td>
                        <td><?php echo $item->description; ?></td>
                        <td style="width:5%"><?php echo $item->qty; ?></td>
                        <td class="text-right"
                            style="width:10%"><?php echo $item->price; ?></td>
                        <td class="text-right" style="width:10%">
                            <?php echo(($item->qty * $item->price)); ?>
                        </td>
                    </tr>
                    <?php
                    $subTotal = $this->invoice->invoice_subtotal($invoice->id);
                }
                ?>
                <tr class="text-info">
                    <td colspan="3" rowspan="5" class="text-info">
                        <h4><?php echo lang('invoice_terms'); ?></h4>

                        <div class="text-muted well well-sm no-shadow"><?php echo $invoice->invoice_terms; ?></div>
                    </td>
                    <td colspan="3" class="no-border">
                        <table class="table table-bordered">

                            <tr class="text-right">
                                <td> <?php echo lang('sub_total'); ?> :</td>
                                <td><?php echo number_format($subTotal, 2); ?></td>
                            </tr>
                            <tr class="text-right text-success">
                                <td class="text-right"><?php echo lang('amount_paid'); ?> :</td>
                                <td>
                                    $ <?php
                                    $totalPaid = $this->invoice->amount_paid($invoice->id);
                                    echo($totalPaid>0 ? number_format($totalPaid, 2) : "0.00"); ?>
                                </td>
                            </tr>
                            <tr class="text-right text-danger">
                                <td> <?php echo lang('amount_due'); ?> :</td>
                                <td>
                                    <?php
                                    $totalDue = $this->invoice->invoice_total_due($invoice->id);
                                    if($totalDue>0 || $totalDue == 0) {
                                        echo $totalDue;
                                    }
                                    if($totalDue<0) {
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
</body>
</html>
<script type="text/javascript">
    $(document).ready(function () {
        //change status
        $("select[name=invoice_change_status]").change(function () {
            var status = $(this).val();
            var fData = {invoice_status: status, invoice_id: '<?php echo $this->uri->segment(3); ?>'};
            $.ajax({
                url: "<?php echo site_url('invoice/update_status'); ?>",
                type: "POST",
                data: fData,
                success: function (data, textStatus, jqXHR) {
                    //data - response from server
                    location.reload();
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    location.reload();
                }
            });
        });
        //update terms
        $('#invoice_terms_btn').click(function () {
            var terms = $('textarea[name=invoice_terms]').val();
            var invoice_id = '<?php echo $this->uri->segment(3); ?>';
            var fData = {invoice_terms: terms, invoice_id: invoice_id};
            $.ajax({
                url: "<?php echo site_url('invoice/update_terms'); ?>/" + invoice_id,
                type: "POST",
                data: fData,
                success: function (data, textStatus, jqXHR) {
                    //data - response from server
                    location.reload();
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    location.reload();
                }
            });
        });
    });
</script>