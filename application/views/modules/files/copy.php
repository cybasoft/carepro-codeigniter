<?php

// copy form POST
if(isset($_POST['copy']) && !FM_READONLY) {
    $copy_files = $_POST['file'];
    if(!is_array($copy_files) || empty($copy_files)) {
        fm_set_msg('Nothing selected', 'alert');
        fm_redirect(FM_SELF_URL.'?p='.urlencode(FM_PATH));
    }

    fm_show_header(); // HEADER
    fm_show_nav_path(FM_PATH); // current path
    ?>
    <div class="path">
        <p><b><?php echo lang('Copying'); ?></b></p>
        <form action="" method="post">
            <input type="hidden" name="p" value="<?php echo fm_enc(FM_PATH) ?>">
            <input type="hidden" name="finish" value="1">
            <?php
            foreach ($copy_files as $cf) {
                echo '<input type="hidden" name="file[]" value="'.fm_enc($cf).'">'.PHP_EOL;
            }
            ?>
            <p class="break-word"><?php echo lang('Files'); ?>: <b><?php echo implode('</b>, <b>', $copy_files) ?></b>
            </p>
            <p class="break-word"><?php echo lang('Source folder'); ?>
                : <?php echo fm_enc(fm_convert_win(FM_ROOT_PATH.'/'.FM_PATH)) ?><br>
                <label for="inp_copy_to"><?php echo lang('Destination folder'); ?>:</label>
                <?php echo FM_ROOT_PATH ?>/<input type="text" name="copy_to" id="inp_copy_to"
                                                  value="<?php echo fm_enc(FM_PATH) ?>">
            </p>
            <p><label><input type="checkbox" name="move" value="1"> <?php echo lang('Move'); ?></label></p>
            <p>
                <button type="submit" class="btn"><i class="fa fa-check-circle"></i> <?php echo lang('Copy'); ?>
                </button> &nbsp;
                <b><a href="?p=<?php echo urlencode(FM_PATH) ?>"><i
                            class="fa fa-times-circle"></i> <?php echo lang('Cancel'); ?></a></b>
            </p>
        </form>
    </div>
    <?php
    fm_show_footer();
    exit;
}

// copy form
if(isset($_GET['copy']) && !isset($_GET['finish']) && !FM_READONLY) {
    $copy = $_GET['copy'];
    $copy = fm_clean_path($copy);
    if($copy == '' || !file_exists(FM_ROOT_PATH.'/'.$copy)) {
        fm_set_msg('File not found', 'error');
        fm_redirect(FM_SELF_URL.'?p='.urlencode(FM_PATH));
    }

    fm_show_header(); // HEADER
    fm_show_nav_path(FM_PATH); // current path
    ?>
    <div class="path">
        <p><b><?php echo lang('Copying'); ?></b></p>
        <p class="break-word">
            <?php echo lang('Source path'); ?>: <?php echo fm_enc(fm_convert_win(FM_ROOT_PATH.'/'.$copy)) ?><br>
            <?php echo lang('Destination folder'); ?>: <?php echo fm_enc(fm_convert_win(FM_ROOT_PATH.'/'.FM_PATH)) ?>
        </p>
        <p>
            <b><a href="?p=<?php echo urlencode(FM_PATH) ?>&amp;copy=<?php echo urlencode($copy) ?>&amp;finish=1"><i
                        class="fa fa-check-circle"></i> <?php echo lang('Copy'); ?></a></b> &nbsp;
            <b><a href="?p=<?php echo urlencode(FM_PATH) ?>&amp;copy=<?php echo urlencode($copy) ?>&amp;finish=1&amp;move=1"><i
                        class="fa fa-check-circle"></i> <?php echo lang('Move'); ?></a></b> &nbsp;
            <b><a href="?p=<?php echo urlencode(FM_PATH) ?>"><i
                        class="fa fa-times-circle"></i> <?php echo lang('Cancel'); ?></a></b>
        </p>
        <p><i><?php echo lang('Select folder'); ?></i></p>
        <ul class="folders break-word">
            <?php
            if($parent !== false) {
                ?>
                <li><a href="?p=<?php echo urlencode($parent) ?>&amp;copy=<?php echo urlencode($copy) ?>"><i
                            class="fa fa-chevron-circle-left"></i> ..</a></li>
                <?php
            }
            foreach ($folders as $f) {
                ?>
                <li>
                    <a href="?p=<?php echo urlencode(trim(FM_PATH.'/'.$f, '/')) ?>&amp;copy=<?php echo urlencode($copy) ?>"><i
                            class="fa fa-folder-o"></i> <?php echo fm_convert_win($f) ?></a></li>
                <?php
            }
            ?>
        </ul>
    </div>
    <?php
    fm_show_footer();
    exit;
}
?>