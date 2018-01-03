<div class="row">
    <div class="col-sm-6">
        <div class="box box-info box-solid">
            <div class="box-header">
                <h3 class="box-title"><?php echo sprintf(lang('child_page_heading'),$child->first_name.' '.$child->last_name); ?></h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="box-body table-responsive">
                <?php $this->load->view($this->module . 'info'); ?>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo lang('parents'); ?></h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool  assign-user-btn">
                        <span class="fa fa-plus"></span>
                    </button>
                </div>
            </div>
            <div class="box-body table-responsive">
                <div class="assign-user"></div>
                <?php $this->load->view($this->module . 'parents'); ?>
            </div>
        </div>
        <?php $this->load->view($this->module . 'pickup'); ?>
    </div>
</div>



