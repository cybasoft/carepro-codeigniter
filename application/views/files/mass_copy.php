<?php
// Mass copy files/ folders
if(isset($_POST['file'], $_POST['copy_to'], $_POST['finish']) && !FM_READONLY) {
    // from
    $path = FM_ROOT_PATH;
    if(FM_PATH != '') {
        $path .= '/'.FM_PATH;
    }
    // to
    $copy_to_path = FM_ROOT_PATH;
    $copy_to = fm_clean_path($_POST['copy_to']);
    if($copy_to != '') {
        $copy_to_path .= '/'.$copy_to;
    }
    if($path == $copy_to_path) {
        fm_set_msg('Paths must be not equal', 'alert');
        fm_redirect(FM_SELF_URL.'?p='.urlencode(FM_PATH));
    }
    if(!is_dir($copy_to_path)) {
        if(!fm_mkdir($copy_to_path, true)) {
            fm_set_msg('Unable to create destination folder', 'error');
            fm_redirect(FM_SELF_URL.'?p='.urlencode(FM_PATH));
        }
    }
    // move?
    $move = isset($_POST['move']);
    // copy/move
    $errors = 0;
    $files = $_POST['file'];
    if(is_array($files) && count($files)) {
        foreach ($files as $f) {
            if($f != '') {
                // abs path from
                $from = $path.'/'.$f;
                // abs path to
                $dest = $copy_to_path.'/'.$f;
                // do
                if($move) {
                    $rename = fm_rename($from, $dest);
                    if($rename === false) {
                        $errors++;
                    }
                } else {
                    if(!fm_rcopy($from, $dest)) {
                        $errors++;
                    }
                }
            }
        }
        if($errors == 0) {
            $msg = $move ? 'Selected files and folders moved' : 'Selected files and folders copied';
            fm_set_msg($msg);
        } else {
            $msg = $move ? 'Error while moving items' : 'Error while copying items';
            fm_set_msg($msg, 'error');
        }
    } else {
        fm_set_msg('Nothing selected', 'alert');
    }
    fm_redirect(FM_SELF_URL.'?p='.urlencode(FM_PATH));
}