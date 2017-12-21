<?php $this->load->view('modules/child/nav'); ?>
<div class="row">
    <div class="col-sm-2 col-lg-2 col-md-2 table-responsive">
        <?php $this->load->view('modules/child/sidebar'); ?>
    </div>
    <div class="col-sm-10 col-lg-10 col-md-10">

        <h2><i class="fa fa-money"></i> <?php echo lang('invoices'); ?></h2>

        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="panel-title">
                    <a href="<?php echo site_url('child/' . $child->id . '/newInvoice'); ?>"
                       class="btn btn-info">
                        <i class="fa fa-plus"></i>
                        <?php echo lang('new_invoice'); ?>
                    </a>
                    <div class="col-sm-4 pull-right">
                        <input type="text" class="invoice_search form-control" name="invoice_search"
                               placeholder="<?php echo lang('search'); ?>" value=""/>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div class="h4">
                    <?php echo lang('sort'); ?>:
                    <input type="radio" name="sort_term" class="invoice_sort radio-inline" value="all"/>
                    <span class="label label-default"><?php echo lang('all'); ?></span> &nbsp;
                    <input type="radio" name="sort_term" class="invoice_sort radio-inline"
                           value="paid"/><?php echo $this->invoice->status(1); ?>&nbsp;
                    <input type="radio" checked name="sort_term" class="invoice_sort radio-inline"
                           value="due"/><?php echo $this->invoice->status(2); ?>&nbsp;
                    <input type="radio" name="sort_term" class="invoice_sort radio-inline"
                           value="cancelled"/><?php echo $this->invoice->status(3); ?>&nbsp;
                    <hr/>
                </div>
                <div id="results"></div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#results').html('<span class="fa fa-spinner fa-spin fa-2x"></span>').load('<?php echo site_url('child/' . $child->id . '/invoices/2'); ?>');

        $('.invoice_sort').click(function () {
            var sort_id = $(this).val();
            $('#results').html('<span class="fa fa-spinner fa-spin fa-2x"></span>').load('<?php echo site_url('child/' . $child->id . '/invoices'); ?>/' + sort_id);
        });

        //search
        var thread = null;

        function findInvoice(search_term) {
            $('#results').html('<div class="loading"></div>').load('<?php echo site_url('child/' . $child->id . '/invoice'); ?>?search=' + search_term);
        }

        $('.invoice_search').keyup(function () {
            clearTimeout(thread);
            var search_term = $(this).val();
            thread = setTimeout(function () {
                findInvoice(search_term);
            }, 300);
        });

    });
</script>