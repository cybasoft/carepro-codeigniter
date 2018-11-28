<div class="card">
    <div class="card-header">
        <button class="btn btn-success btn-sm pull-right newMedModal" id="<?php echo $child->id; ?>">
            <span class="fa fa-plus-circle"></span>
            <?php echo lang('Add new'); ?>
        </button>
        <?php if(is(['admin', 'manager', 'staff'])): ?>
            <button class="btn btn-warning btn-xs" id="medImagesModalBtn">
                <span class="fa fa-plus-circle"></span>
                <?php echo lang('Medication images'); ?>
            </button>
        <?php endif; ?>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-lg-12">
                <?php foreach ($child->meds as $med): ?>
                    <?php
                    if(!empty($med->photo)) {
                        $photo = '/uploads/meds/'.$med->photo;
                    } else {
                        $photo = '/img/content/pills.svg';
                    }
                    ?>
                    <div class="info-box">
                        <div class="info-box-icon"
                             style="background:#fff url('<?php echo base_url('assets/'.$photo); ?>');background-size: 64px;
                                     background-repeat: no-repeat;">
                        </div>
                        <div class="info-box-content">
                            <span class="info-box-text text-warning"><?php echo $med->med_name; ?></span>
                            <?php echo $med->med_notes; ?>

                            <div class="info-box-more">
                                <br/>

                                <?php if(!is('parent')): ?>
                                    <a class="adminMedModal"
                                       data-name="<?php echo $med->med_name; ?>"
                                       data-desc="<?php echo $med->med_notes; ?>"
                                       data-medId="<?php echo $med->id; ?>"
                                       data-toggle="modal"
                                       data-target="#medAdminModal"
                                       href="#"><?php echo lang('Administer'); ?></a>

                                    <span id="<?php echo $med->id; ?>"
                                          class="text-danger pull-right delete-med cursor">
                                        <span class="fa fa-trash-alt cursor delete"></span>
                                        <?php echo lang('Delete'); ?>
                                    </span>
                                <?php endif; ?> |
                                <a class="medHistory"
                                   id="<?php echo $med->id; ?>"
                                   data-toggle="modal"
                                   data-target="#historyModal"
                                   href="#"><?php echo lang('View history'); ?></a>

                                |
                                <span class="text-muted"><?php echo lang('Added on').': '.format_date($med->created_at); ?></span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<div id="med-modal"></div>
<?php $this->load->view($this->module.'meds/med_admin_modal.php'); ?>
