<link href="<?php echo base_url('assets/plugins/dz/dropzone.min.css'); ?>" rel="stylesheet">
<link type="text/css" rel="stylesheet" href="<?php echo base_url('assets/plugins/lg/css/lightgallery.min.css'); ?>"/>
<?php $incident = $this->db->where('id', $_GET['viewIncident'])->get('child_incident')->row();
$photos = $this->photos->albums('child_incident_photos', $child->id, null, base_url('child/1/notes?viewIncident=4#view-notes'));
if(count($incident)>0):
?>
<div class="row">
    <div class="col-md-8">
        <table class="table table-responsive table-striped">
            <tr>
                <td colspan="2">
                    <h3 class="text-danger"><?php echo $incident->title; ?></h3>
                    <em>
                        <?php
                        echo sprintf(lang('created on %s by %s'),
                            format_date($incident->created_at),
                            $this->user->user($incident->user_id)->first_name.' '
                            .$this->user->user($incident->user_id)->last_name);
                        ?>

                    </em>
                </td>
            </tr>
            <tr>
                <td><strong><?php echo lang('incident date'); ?>:</strong></td>
                <td><?php echo format_date($incident->date_occurred); ?></td>
            </tr>
            <tr>
                <td><strong><?php echo lang('incident_type'); ?>:</strong></td>
                <td><?php echo $incident->incident_type; ?></td>
            </tr>
            <tr>
                <td><strong><?php echo lang('location'); ?>:</strong></td>
                <td>  <?php echo $incident->location; ?></td>
            </tr>
            <tr>
                <td colspan="2"><strong><?php echo lang('description'); ?></strong> <br/>
                    <?php echo $incident->description; ?>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <strong><?php echo lang('actions_taken'); ?></strong><br/>
                    <?php echo $incident->actions_taken; ?>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <strong><?php echo lang('actions_taken'); ?></strong><br/>
                    <?php echo $incident->actions_taken; ?>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <strong><?php echo lang('witnesses'); ?></strong><br/>
                    <?php echo $incident->witnesses; ?>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <strong><?php echo lang('remarks'); ?></strong><br/>
                    <?php echo $incident->remarks; ?>
                </td>
            </tr>
        </table>
    </div>
    <div class="col-md-4">
        <strong class="text-danger"><?php echo lang('incident photos'); ?></strong>
        <?php if(is('admin') || is('staff') || is('manager')): ?>
            <form action="<?php echo site_url('child/'.$child->id.'/photos/incident'); ?>"
                  enctype="multipart/form-data" class="dropzone" id="image-upload" method="POST">
                <input type="hidden" name="incident_id" value="<?php echo $incident->id; ?>">
            </form>
        <?php endif; ?>
        <div class="flexbin flexbin-margin" id="lightgallery">
            <?php if(count($photos['results'])>0): ?>
            <?php foreach ($photos['results'] as $photo): ?>
                <a href="<?php echo base_url('assets/uploads/photos/'.$photo->photo); ?>">
                    <?php if(is('admin') || is('staff') || is('manager')): ?>
                        <span class="text-danger deletePhoto" id="<?php echo $photo->id; ?>"
                              style="position:absolute;right:0;padding:2px;background:#fff;">
                        <i class="fa fa-trash-o"></i>
                    </span>
                    <?php endif; ?>
                    <img src="<?php echo base_url('assets/uploads/photos/'.$photo->photo); ?>"/>
                </a>
            <?php endforeach; ?>
        </div>
    <?php if(isset($photos['links'])) { ?>
        <?php echo $photos['links']; ?>
    <?php } ?>
    <?php endif; ?>
    </div>
    <?php endif; ?>
</div>
<?php if(is('admin') || is('staff') || is('manager')): ?>
    <script src="<?php echo base_url('assets/plugins/dz/dropzone.min.js'); ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/plugins/lg/js/lightgallery.min.js'); ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/plugins/lg/js/lg-thumbnail.min.js'); ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/plugins/lg/js/lg-fullscreen.min.js'); ?>" type="text/javascript"></script>
    <script type="text/javascript">
        $('a[href=#view-notes]').find('i').append(' <?php echo $incident->title; ?>');
        Dropzone.options.imageUpload = {
            maxFilesize: 3,
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            dictDefaultMessage: "<?php echo lang('dropzone_message'); ?>"
            //previewsContainer: ".flexbin",
            //clickable: true
        };
        lightGallery(document.getElementById('lightgallery'));
        $('.deletePhoto').click(function () {
            var photo = $(this);
            swal({
                title: '<?php echo lang('confirm_delete_title'); ?>',
                text: '<?php echo lang('confirm_delete_warning'); ?>',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#DD6B55',
                confirmButtonText: '<?php echo lang('confirm_delete_btn'); ?>',
                closeOnConfirm: false,
                backdrop: false,
                allowOutsideClick: false
            }, function () {
                swal({type: 'success', text: '<?php echo lang('request_success'); ?>'});
                $.ajax({
                    url: '<?php echo base_url('/child/'.$child->id.'/photos/destroyIncidentPhotos'); ?>',
                    data: {id: photo.attr('id')}, //$('form').serialize(),
                    type: 'POST',
                    success: function (response) {
                        if (response === "success") {
                            photo.parent('a').remove();
                        } else {
                            swal({type: 'error', text: '<?php echo lang('request_error'); ?>'})
                        }
                    },
                    error: function (error) {
                        swal({type: 'error', text: '<?php echo lang('request_error'); ?>'})
                    }
                });
            })
        })
    </script>
<?php endif; ?>