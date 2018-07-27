
<div class="callout callout-success">
    <h3>
        <?php echo lang('Checked in'); ?>
    </h3>
    10:00 AM | 6hrs ago | expected checkout at 5pm
</div>

<div class="callout callout-info">
    <h3>
        <?php echo lang('Not checked in'); ?>
    </h3>
</div>

<div class="box box-info box-solid">
    <div class="box-header">
        <h3 class="box-title"><?php echo sprintf(lang('child_page_heading'), $child->first_name.' '.$child->last_name); ?></h3>
        <div class="box-tools pull-right">
            <?php if(is('admin') || is('staff')): ?>
                <a href="#" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#updateChildModal"><span
                            class="fa fa-pencil-alt"></span>
                </a>
            <?php endif; ?>
        </div>
    </div>
    <div class="box-body table-responsive">
        <?php if(!empty($child->nickname)): ?>
            <div class="row text-primary">
                <div class="col-md-6">
                    <strong><?php echo lang('nickname'); ?></strong>:
                    <?php echo $child->nickname; ?>
                </div>
            </div>
        <?php endif; ?>
        <div class="row">
            <div class="col-md-6">
                <strong><?php echo lang('name'); ?></strong>:
                <?php echo $child->first_name.' '.$child->last_name; ?>
            </div>
            <div class="col-md-6">
                <strong><?php echo lang('date_of_birth'); ?></strong>:
                <?php echo format_date($child->bday, false); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <strong><?php echo lang('national_id'); ?></strong>:
                <?php echo decrypt($child->national_id); ?>
            </div>
            <div class="col-md-6">
                <strong><?php echo lang('gender'); ?></strong>:
                <?php echo $child->gender; ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <strong><?php echo lang('blood_type'); ?></strong>:
                <?php echo $child->blood_type; ?>
            </div>
            <div class="col-md-6">
                <strong><?php echo lang('ethnicity'); ?></strong>:
                <?php echo $child->ethnicity; ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <strong><?php echo lang('religion'); ?></strong>:
                <?php echo $child->religion; ?>
            </div>
            <div class="col-md-6">
                <strong><?php echo lang('birthplace'); ?></strong>:
                <?php echo $child->birthplace; ?>
            </div>
        </div>
    </div>
</div>

<?php if(is('admin') || is('staff')): ?>
   <?php $this->load->view($this->module.'update_child_modal'); ?>
<?php endif; ?>