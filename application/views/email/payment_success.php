<h4><?php echo lang('invoice_payment_received'); ?></h4>
<p><?php echo lang('invoice_payment_received_message'); ?></p>
<table>
    <tr>
        <td>ID</td>
        <td><?php echo $data['invoice']['id']; ?></td>
    </tr>    <tr>
        <td><?php echo lang('description'); ?></td>
        <td><?php echo $data['invoice']['description']; ?></td>
    </tr>
    <tr>
        <td><?php echo lang('amount'); ?></td>
        <td><?php echo moneyFormat($data['invoice']['amount']); ?></td>
    </tr>
    <tr>
        <td><?php echo lang('payment_method'); ?></td>
        <td><?php echo $data['invoice']['method']; ?></td>
    </tr>
    <tr>
        <td><?php echo lang('remarks'); ?></td>
        <td><?php echo $data['invoice']['remarks']; ?></td>
    </tr>

</table>