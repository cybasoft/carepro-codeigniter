<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?php echo lang('Invoice'); ?></title>
    <style type="text/css">
        body {
            background-color: #fff;
            font: 13px/20px normal, Courier, Arial, sans-serif;
            color: #4F5155;
        }

        h1 {
            color: #444;
            background-color: transparent;
            border-bottom: 1px solid #D0D0D0;
            font-size: 19px;
            font-weight: normal;
            margin: 0 0 14px 0;
            padding: 14px 15px 10px 0px;
        }

        table {
            width: 100%;
        }

        th {
            font-weight: bolder;
        }

        table th, .invoice-items td {
            text-align: right;
        }

        #logo {
            width: 150px;
        }
    </style>
</head>
<body>
<h1>
    <small><?php echo lang('Parents of'); ?></small>
    <?php echo $child->first_name.' '.$child->last_name; ?>
</h1>

<table style="width:100%;">
    <tr>
        <td>
            <strong><?php echo lang('Invoice'); ?>#:</strong>
            <?php echo $invoice->id; ?>
        </td>
        <td rowspan="5" style="text-align: right;">
            <img style="width:200px"
                 src="<?php echo APPPATH.'../assets/uploads/content/'.session('company_invoice_logo'); ?>"/>
            <br/>
            <strong><?php echo session('company_name'); ?></strong><br/>
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
        </td>
    </tr>
    <tr>
        <td>
            <strong><?php echo lang('Status'); ?></strong>
            <?php echo lang($invoice->invoice_status); ?>
        </td>
    </tr>
    <tr>
        <td>
            <strong><?php echo lang('date'); ?>:</strong>
            <?php echo format_date($invoice->created_at, false); ?>
        </td>
    </tr>
    <tr>
        <td>
            <strong><?php echo lang('due'); ?>:</strong>
            <?php echo format_date($invoice->date_due, false); ?>
        </td>
    </tr>

</table>
<p><br/></p>
<table>
    <tr>
        <th><?php echo lang('item'); ?></th>
        <th><?php echo lang('description'); ?></th>
        <th><?php echo lang('quantity'); ?></th>
        <th><?php echo lang('amount'); ?></th>
        <th><?php echo lang('sub_total'); ?></th>
    </tr>
    <tbody>
    <?php foreach ($invoice_items as $item) {
        ?>
        <tr class="invoice-items">
            <td>
                <?php echo $item->item_name; ?>
            </td>
            <td>
                <?php echo $item->description; ?>
            </td>

            <td>
                <?php echo $item->qty; ?>
            </td>
            <td>
                <?php echo moneyFormat($item->price, true); ?>
            </td>

            <td>
                <?php echo moneyFormat($item->qty * $item->price, true); ?>
            </td>
        </tr>
        <?php
        $subTotal = $this->invoice->subTotal($invoice->id);
    }
    ?>
    <tr>
        <td colspan="5">
            <hr/>
        </td>
    </tr>
    <tr class="invoice-items">
        <td colspan="4"><?php echo lang('sub_total'); ?> :</td>
        <td>
            <?php echo moneyFormat($subTotal, true); ?>
        </td>
    </tr>
    <tr class="invoice-items" style="color:green">
        <td colspan="4">
            <?php echo lang('amount_paid'); ?> :
        </td>
        <td>
            <?php
            echo session('currency_symbol');
            $totalPaid = $this->invoice->amountPaid($invoice->id);

            echo($totalPaid > 0 ? moneyFormat($totalPaid, true) : "0.00"); ?>
        </td>
    </tr>
    <tr class="invoice-items" style="font-weight:bold;color:red">
        <td colspan="4">
            <?php echo lang('amount_due'); ?> :
        </td>
        <td>
            <?php

            $totalDue = (float)$subTotal - (float)$totalPaid;
            if($totalDue > 0) {
                echo moneyFormat($totalDue, true);
            } else {
                echo ' <span style="color:green"> '.lang('refund').' </span > '.moneyFormat($totalDue, true);
            }
            ?>
        </td>
    </tr>
    </tbody>
</table>

<h4><?php echo lang('invoice_terms'); ?></h4>
<?php echo $invoice->invoice_terms; ?>
</body>
</html>
