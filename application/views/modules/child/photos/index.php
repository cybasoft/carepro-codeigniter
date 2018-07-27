<?php $this->load->view('modules/child/nav'); ?>

<link href="<?php echo base_url('assets/plugins/dz/dropzone.min.css'); ?>" rel="stylesheet">
<link type="text/css" rel="stylesheet" href="<?php echo base_url('assets/plugins/lg/css/lightgallery.min.css'); ?>"/>

<div class="row">
    <div class="col-sm-2 col-lg-2 col-md-2 table-responsive">
        <?php $this->load->view('modules/child/sidebar'); ?>
    </div>
    <div class="col-sm-10 col-lg-10 col-md-10">
        <?php if(is('admin') || is('staff') || is('manager')): ?>
            <form action="<?php echo site_url('photos/store'); ?>"
                  enctype="multipart/form-data" class="dropzone" id="image-upload" method="POST">
                <?php echo form_hidden('child_id',$child->id); ?>
            </form>
        <?php endif; ?>
        <div class="flexbin flexbin-margin" id="lightgallery">
            <?php if(count($photos['results'])): ?>
            <?php foreach ($photos['results'] as $photo): ?>
                <a data-src="<?php echo base_url('assets/uploads/photos/'.$photo->name); ?>?id=<?php echo $photo->id; ?>?route=/photos/destroy">
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

<script type="text/javascript">
    Dropzone.options.imageUpload = {
        maxFilesize: 3,
        acceptedFiles: ".jpeg,.jpg,.png,.gif",
        dictDefaultMessage: "<?php echo lang('dropzone_message'); ?>"
        //previewsContainer: ".flexbin",
        //clickable: true
    };

    lightGallery(document.getElementById('lightgallery'));

</script>