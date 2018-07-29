<h2><?php echo lang('medications'); ?>
    <button class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#newMedModal">
        <span class="fa fa-plus-circle"></span>
        <?php echo lang('Add new'); ?>
    </button>
    <?php if(is(['admin','manager','staff'])): ?>
    <button class="btn btn-warning btn-xs" data-toggle="modal" data-target="#medImagesModal">
        <span class="fa fa-plus-circle"></span>
        <?php echo lang('Medication images'); ?>
    </button>
    <?php endif; ?>
</h2>

<hr/>

<div class="row">
    <div class="col-lg-12">
        <?php
        $this->db->where('child_id', $child->id);
        $meds = $this->db->get('child_meds');
        ?>
        <?php if($meds->num_rows()>0): ?>
            <?php foreach ($meds->result() as $med) {
                ?>
                <div class="info-box">
                    <div class="info-box-icon"
                         style="background:#fff url('<?php echo $this->health->medPhoto($med->photo_id); ?>');background-size: 64px;
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

                                <a href="<?php echo site_url('meds/destroy/'.$med->id); ?>"
                                   class="delete text-danger pull-right">
                                    <span class="fa fa-trash-alt cursor"></span>
                                    <?php echo lang('Delete'); ?>
                                </a>
                            <?php endif; ?> |
                            <a class="medHistory"
                               id="<?php echo $med->id; ?>"
                               data-toggle="modal"
                               data-target="#historyModal"
                               href="#"><?php echo lang('View history'); ?></a>

                        </div>
                    </div>
                </div>
                <?php
            }
            ?>

        <?php else: ?>
            <h3 class="alert alert-warning"><?php echo lang('nothing_to_display'); ?></h3>
        <?php endif; ?>
    </div>
</div>


<?php $this->load->view($this->module.'meds/create_med_modal.php'); ?>
<?php $this->load->view($this->module.'meds/med_images_modal.php'); ?>
<?php $this->load->view($this->module.'meds/med_admin_modal.php'); ?>
<?php $this->load->view($this->module.'meds/med_history_modal.php'); ?>

<script>
    $('.adminMedModal').click(function () {
        var med_id = $(this).attr('data-medId');
        var modal = $('#medAdminModal');
        modal.find('input[name=med_id]').val(med_id);
        modal.find('.medName').text($(this).attr('data-name'));
        modal.find('.medNotes').text($(this).attr('data-desc'));
    })
    $('.medHistory').click(function () {
        var modal = $('#medHistoryModal');
        var med_id = $(this).attr('id');
        $.ajax({
            url: '<?php echo site_url('meds/history'); ?>/' + med_id,
            type: 'GET',
            success: function (response) {
              //var records = JSON.parse(response);
               modal.find('#modal-content').html(response);
                modal.modal('show')
            },
            error: function (error) {
                console.log(error);
            }
        });
    })
</script>
