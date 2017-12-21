<div class="tabs">
    <ul class="nav nav-tabs">
        <li>
            <a href="#c_invoice" data-toggle="tab"><i class="fa fa-time"></i> <?php echo lang('invoice'); ?></a>
        </li>
        <li>
            <a href="#payments" data-toggle="tab"><i class="fa fa-credit-card"></i> <?php echo lang('payments'); ?></a>
        </li>
    </ul>
    <div class="tab-content">
        <!--pending-->
        <div class="tab-pane active" id="c_invoice">
            <div class="bg-warning">
                <?php echo lang('sort'); ?>:
                <input type="radio" name="sort_term" checked class="invoice_sort radio-inline" value="0"/>
                <span class="label label-default"><?php echo lang('all'); ?></span> &nbsp;
                <input type="radio" name="sort_term" class="invoice_sort radio-inline"
                       value="1"/><?php echo $this->invoice->status(1); ?> &nbsp;
                <input type="radio" name="sort_term" class="invoice_sort radio-inline"
                       value="2"/><?php echo $this->invoice->status(2); ?> &nbsp;
                <input type="radio" name="sort_term" class="invoice_sort radio-inline"
                       value="3"/><?php echo $this->invoice->status(3); ?>
                <hr/>
            </div>
            <div id="results"></div>
        </div>
        <!--payments-->
        <div class="tab-pane" id="payments">
            <?php $this->load->view('modules/children/accounting/payments'); ?>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        //load all by default
        $('#results').html('<div class="loading"></div>').load('<?php echo site_url('parents/invoice'); ?>');

        //sort by status
        $('.invoice_sort').click(function () {
            var sort_id = $(this).attr('value');
            $('#results').html('<div class="loading"></div>').load('<?php echo site_url('parents/invoice'); ?>/' + sort_id);
        });

        //search
        var thread = null;
        function findInvoice(search_term) {
            $('#results').html('<div class="loading"></div>').load('<?php echo site_url('parents/invoice'); ?>/' + search_term + '/?do=search');
        }
        $('.invoice_search').keyup(function() {
            clearTimeout(thread);
            var search_term = $(this).val();
            thread = setTimeout(function() { findInvoice(search_term); }, 300);
        });
        //delete item
        $('.delete_invoice_btn').click(function(){
            alert();
            var invoice_id = $(this).attr('id');
            if(confirm("<?php echo lang('confirm_delete_item'); ?>")){
                // window.location.href="<?php echo site_url('invoice/delete_invoice'); ?>/"+invoice_id;
            }
        });
    });
</script>