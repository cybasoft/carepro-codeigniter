<?php $this->load->view('modules/child/nav'); ?>

<link href="<?php echo base_url('assets/plugins/dz/dropzone.min.css'); ?>" rel="stylesheet">
<link type="text/css" rel="stylesheet" href="<?php echo base_url('assets/plugins/lg/css/lightgallery.min.css'); ?>"/>

<div class="row">
    <div class="col-sm-2 col-lg-2 col-md-2 table-responsive">
        <?php $this->load->view('modules/child/sidebar'); ?>
    </div>
    <div class="col-sm-10 col-lg-10 col-md-10">
        <?php if(is('admin') || is('staff') || is('manager')): ?>
            <form action="<?php echo site_url('child/'.$child->id.'/photos/store'); ?>"
                  enctype="multipart/form-data" class="dropzone" id="image-upload" method="POST">
            </form>
        <?php endif; ?>
        <div class="flexbin flexbin-margin" id="lightgallery">
            <?php if(count($photos['results'])): ?>
            <?php foreach ($photos['results'] as $photo): ?>
                <a href="<?php echo base_url('assets/uploads/photos/'.$photo->name); ?>">
                    <?php if(is('admin') || is('staff') || is('manager')): ?>
                        <span class="text-danger deletePhoto" id="<?php echo $photo->id; ?>"
                              style="position:absolute;right:0;padding:2px;background:#fff;">
                        <i class="fa fa-trash-o"></i>
                    </span>
                    <?php endif; ?>
                    <img src="<?php echo base_url('assets/uploads/photos/'.$photo->name); ?>"/>
                </a>
            <?php endforeach; ?>
        </div>
    <?php if(isset($photos['links'])) { ?>
        <?php echo $photos['links']; ?>
    <?php } ?>
    <?php endif; ?>
    </div>
</div>

<script src="<?php echo base_url('assets/plugins/dz/dropzone.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/plugins/lg/js/lightgallery.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/plugins/lg/js/lg-thumbnail.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/plugins/lg/js/lg-fullscreen.min.js'); ?>" type="text/javascript"></script>
<!--href="<?php echo site_url('photo/'.$photo->id.'/delete'); ?>"-->
<script type="text/javascript">
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
                url: '<?php echo base_url('/child/'.$child->id.'/photos/destroy'); ?>',
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