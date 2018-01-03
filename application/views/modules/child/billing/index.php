<?php $this->load->view('modules/child/nav'); ?>
<div class="row">
    <div class="col-sm-2 col-lg-2 col-md-2 table-responsive">
        <?php $this->load->view('modules/child/sidebar'); ?>
    </div>
    <div class="col-sm-10 col-lg-10 col-md-10">

        <h2><i class="fa fa-money"></i> <?php echo lang('invoices'); ?></h2>

        <div class="box box-solid box-primary">
            <div class="box-header">
                <h3 class="box-title">
                    <?php if (!is('parent')): ?>
                        <a href="<?php echo site_url('child/' . $child->id . '/newInvoice'); ?>"
                           class="btn btn-info">
                            <i class="fa fa-plus"></i>
                            <?php echo lang('new_invoice'); ?>
                        </a>
                    <?php endif; ?>
                </h3>
                <div class="box-tools pull-right">
                    <form class="invoice_search col-sm-6 pull-right">
                        <div class="input-group">
                            <input type="text" class="form-control" name="invoice_search"
                                   placeholder="<?php echo lang('enter_invoice_id'); ?>" value=""/>
                            <span class="input-group-btn">
                                <button class="btn btn-warning"><i class="fa fa-search"></i></button>
                                    </span>
                        </div>
                    </form>
                </div>
            </div>
            <div class="box-body">
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

        $('.invoice_search').on('submit', function (e) {
            e.preventDefault();
            var search_term = $(this).find('input[name=invoice_search]').val();
            if (search_term === "") {
                swal('<?php echo lang('enter_a_search_term'); ?>' + code);
                return;
            }
            $('#results').html('<div class="loading"></div>').load('<?php echo site_url('child/' . $child->id . '/invoices/search'); ?>?search=' + search_term);
        });

    });
</script>