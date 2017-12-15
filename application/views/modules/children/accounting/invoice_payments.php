<div class="panel panel-default">
    <div class="panel-heading">
        <?php echo lang('payments_header'); ?>
    </div>
    <div class="panel-body">
        <table class="table table-stripped">
            <th><?php echo lang('invoice'); ?></th>
            <th><?php echo lang('amount'); ?></th>
            <th><?php echo lang('date'); ?></th>
            <th><?php echo lang('method'); ?></th>
            <th><?php echo lang('notes'); ?></th>
            <?php
            $this->db->where('invoice_id',$this->uri->segment(3));
            $query = $this->db->get('accnt_invoice_payments');
            foreach ($query->result() as $row):
                ?>
                <tr>
                    <td>
                        <?php echo anchor('invoice/invoice_preview/'.$row->invoice_id,$row->invoice_id); ?>
                    </td>
                    <td>
                        <?php echo $this->curr. $row->amount_paid; ?>
                    </td>
                    <td>
                        <?php echo $row->date_paid; ?>
                    </td>
                    <td>
                        <?php echo $this->invoice->pay_method($row->method); ?>
                    </td>
                    <td>
                        <?php echo $row->remarks; ?>
                    </td>
                </tr>
            <?php  endforeach; ?>
        </table>
    </div>
</div>