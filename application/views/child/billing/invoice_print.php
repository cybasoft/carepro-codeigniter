<!DOCTYPE html>
<html moznomarginboxes mozdisallowselectionprint>
<head>
    <meta charset="UTF-8">
    <title><?php echo session('company_name'); ?></title>
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

        .stamp {
            margin-top: 40px;
            border: solid 2px #333;
            padding: 5px;
            width: 200px;
            text-transform: uppercase;
            text-shadow: 1px 1px #333;
        }

        .stamp-paid {
            color: #24893c;
            border: 1px solid #2ccc59;
        }

        .stamp-cancelled, .stamp-due {
            color: red;
            border: solid 1px red;
        }
    </style>
    <script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>
</head>
<!--<body>-->
<body onload="javascript:print()">
<div class="container" style="font-family: courier, monospace">
    <div class="text-center">
        <img style="width:200px;"
             src="<?php echo base_url(); ?>assets/uploads/content/<?php echo session('company_invoice_logo'); ?>"/>
    </div>
    <h1 class="text-center"><?php echo lang('INVOICE'); ?></h1>
    <hr/>

    <?php echo lang('Parents of'); ?>
    <h2><?php echo $this->child->get($invoice->child_id, 'name'); ?></h2>
    <div class="row">

        <div class="col-sm-4 invoice-col">
            <table class="table">
                <tr>
                    <td><?php echo lang('invoice'); ?>#:</td>
                    <td> <?php echo $invoice->id; ?></td>
                </tr>
                <tr>
                    <td><?php echo lang('date'); ?>:</td>
                    <td><?php echo format_date($invoice->created_at, false); ?></td>
                </tr>
                <tr>
                    <td><?php echo lang('due'); ?>:</td>
                    <td><?php echo format_date($invoice->date_due, false); ?></td>
                </tr>
            </table>
        </div>


        <div class="col-sm-4 col-sm-offset-4 invoice-col text-right">
            <div class="card">
                <div class="card-header bg-light-blue">
                </div>
                <div class="card-body">
                    <?php
                    $street = session('company_street');
                    $street2 = session('company_street2');
                    $city = session('company_city');
                    $state = session('company_state');
                    $zip = session('company_postal_code');
                    ?>
                    <?php
                    echo !empty($street) ? $street.'<br/>' : ''; ?>
                    <?php echo !empty($street2) ? $street2.'<br/>' : ''; ?>
                    <?php echo !empty($city) ? $city.',' : ''; ?>
                    <?php echo !empty($state) ? $state : ','; ?>
                    <?php echo !empty($zip) ? $zip.'<br/>' : '';
                    echo session('company_phone'); ?><br/>
                    <?php echo session('company_email'); ?><br/>
                    <?php echo site_url(); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="stamp text-center stamp-<?php echo $invoice->invoice_status; ?>">
        <span><?php echo $invoice->invoice_status; ?></span>
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
                $totalTax = 0;
                ?>
                <?php foreach ($invoice_items as $item): ?>
                    <tr id="new_item">
                        <td style="width:20%"><?php echo $item->item_name; ?></td>
                        <td><?php echo $item->description; ?></td>
                        <td style="width:5%"><?php echo $item->qty; ?></td>
                        <td class="text-right"
                            style="width:10%"><?php echo moneyFormat($item->price, true); ?></td>
                        <td class="text-right" style="width:10%">
                            <?php echo moneyFormat($item->qty * $item->price, true); ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <tr class="text-right">
                    <td colspan="2" style="border:none !important;"></td>
                    <td colspan="2"><?php echo lang('sub_total'); ?> :</td>
                    <td><?php echo moneyFormat($this->invoice->subTotal($invoice->id), true); ?></td>
                </tr>
                <tr class="text-right text-success">
                    <td colspan="2" style="border:none !important;"></td>
                    <td colspan="2" class="text-right"><?php echo lang('amount_paid'); ?> :</td>
                    <td>
                        <?php
                        $totalPaid = $this->invoice->amountPaid($invoice->id);
                        echo $totalPaid > 0 ? moneyFormat($totalPaid, true) : moneyFormat(0.00, true); ?>
                    </td>
                </tr>
                <tr class="text-right text-danger">
                    <td colspan="2" style="border:none !important;"></td>
                    <td colspan="2"><?php echo lang('amount_due'); ?> :</td>
                    <td>
                        <?php
                        $totalDue = $this->invoice->amountDue($invoice->id);
                        if($totalDue > 0 || $totalDue == 0) {
                            echo moneyFormat($totalDue, 2);
                        }
                        if($totalDue < 0) {
                            echo '<span class="label label-success">'.lang('refund').'</span> ';
                            echo moneyFormat($totalDue, true);
                        }
                        ?>
                    </td>
                </tr>
                </tbody>
            </table>

            <?php if(!empty($invoice->invoice_terms)): ?>
                <h4><?php echo lang('invoice_terms'); ?></h4>

                <div class="text-muted well well-sm no-shadow"><?php echo $invoice->invoice_terms; ?></div>
            <?php endif; ?>

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
                url: site_url+'invoice/update_status',
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
                url: site_url+'invoice/update_terms/' + invoice_id,
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