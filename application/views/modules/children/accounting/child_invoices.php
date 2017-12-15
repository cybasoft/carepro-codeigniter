
<div class="panel panel-primary">
    <div class="panel-heading">
        <?php echo anchor('invoice/create_invoice', '<i class="glyphicon glyphicon-plus-sign"></i> '
            . lang('new_invoice'), 'class="btn btn-info"'); ?>
        <div class="col-sm-4 pull-right">
            <input type="text" class="invoice_search" name="invoice_search"
                   placeholder="<?php echo lang('search'); ?>" value=""/>
        </div>
    </div>
    <div class="h4">
        <?php echo lang('sort'); ?>:
        <input type="radio" checked name="sort_term" class="invoice_sort radio-inline" value="0"/>
        <span class="label label-default"><?php echo lang('all'); ?></span> &nbsp;
        <input type="radio" name="sort_term" class="invoice_sort radio-inline"
               value="1"/><?php echo $this->invoice->invoice_status(1); ?>&nbsp;
        <input type="radio" name="sort_term" class="invoice_sort radio-inline"
               value="2"/><?php echo $this->invoice->invoice_status(2); ?>&nbsp;
        <input type="radio" name="sort_term" class="invoice_sort radio-inline"
               value="3"/><?php echo $this->invoice->invoice_status(3); ?>&nbsp;
        <hr/>
    </div>
    <div id="results"></div>
</div>

<script>
    $(document).ready(function () {
        $('#results').html('<div class="loading"></div>').load('<?php echo site_url('children/invoice'); ?>/0');

        $('.invoice_sort').click(function () {
            var sort_id = $(this).val();
            $('#results').html('<div class="loading"></div>').load('<?php echo site_url('children/invoice'); ?>/' + sort_id);
        });

        //search
        var thread = null;
        function findInvoice(search_term) {
            $('#results').html('<div class="loading"></div>').load('<?php echo site_url('children/invoice'); ?>?search=' + search_term);
        }
        $('.invoice_search').keyup(function() {
            clearTimeout(thread);
            var search_term = $(this).val();
            thread = setTimeout(function() { findInvoice(search_term); }, 300);
        });

    });
</script>