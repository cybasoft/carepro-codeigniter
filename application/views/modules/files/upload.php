<?php
if(isset($_GET['upload']) && !FM_READONLY) {
    fm_show_header(); // HEADER
    fm_show_nav_path(FM_PATH); // current path
    ?>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.js"></script>

    <div class="path">
        <p class="break-word label label-default"><?php echo lang('Uploading to').' '.fm_enc(fm_convert_win('/'.FM_PATH)) ?></p>
        <form action="<?php echo site_url('files/upload/?p='.fm_enc(FM_PATH)); ?>" class="dropzone"
              id="fileuploader" enctype="multipart/form-data">
            <input type="hidden" name="p" value="<?php echo fm_enc(FM_PATH) ?>">
            <div class="fallback">
                <input name="file" type="file" multiple/>
            </div>
        </form>

    </div>
    <?php
    fm_show_footer();
    exit;
}
?>