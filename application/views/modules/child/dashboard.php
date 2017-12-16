<div class="row">
    <div class="col-sm-6">
        <div class="box box-info box-solid">
            <div class="box-header">
                <div class="box-title"><?php echo $child->fname; ?>'s Profile</div>
            </div>
            <div class="box-body table-responsive">
                <?php $this->load->view($this->module . 'info'); ?>
            </div>
        </div>
    </div>
    <div class="col-sm-6">

        <div class="box box-solid box-primary">
            <div class="box-header">
                <div class="box-title btn-block"><?php echo lang('parents'); ?>
                    <span class="fa fa-plus assign-user-btn pull-right"></span>
                </div>
            </div>
            <div class="box-body table-responsive">
                <div class="assign-user"></div>
                <?php $this->load->view($this->module . 'parents'); ?>
            </div>
        </div>
    </div>
</div>