<?php
if(isset($_GET['copy'], $_GET['finish']) && !FM_READONLY) {
    // from
    $copy = $_GET['copy'];
    $copy = fm_clean_path($copy);
    // empty path
    if($copy == '') {
        fm_set_msg('Source path not defined', 'error');
        fm_redirect(FM_SELF_URL.'?p='.urlencode(FM_PATH));
    }
    // abs path from
    $from = FM_ROOT_PATH.'/'.$copy;
    // abs path to
    $dest = FM_ROOT_PATH;
    if(FM_PATH != '') {
        $dest .= '/'.FM_PATH;
    }
    $dest .= '/'.basename($from);
    // move?
    $move = isset($_GET['move']);
    // copy/move
    if($from != $dest) {
        $msg_from = trim(FM_PATH.'/'.basename($from), '/');
        if($move) {
            $rename = fm_rename($from, $dest);
            if($rename) {
                fm_set_msg(sprintf('Moved from <b>%s</b> to <b>%s</b>', fm_enc($copy), fm_enc($msg_from)));
            } elseif($rename === null) {
                fm_set_msg('File or folder with this path already exists', 'alert');
            } else {
                fm_set_msg(sprintf('Error while moving from <b>%s</b> to <b>%s</b>', fm_enc($copy), fm_enc($msg_from)), 'error');
            }
        } else {
            if(fm_rcopy($from, $dest)) {
                fm_set_msg(sprintf('Copyied from <b>%s</b> to <b>%s</b>', fm_enc($copy), fm_enc($msg_from)));
            } else {
                fm_set_msg(sprintf('Error while copying from <b>%s</b> to <b>%s</b>', fm_enc($copy), fm_enc($msg_from)), 'error');
            }
        }
    } else {
        fm_set_msg('Paths must be not equal', 'alert');
    }
    fm_redirect(FM_SELF_URL.'?p='.urlencode(FM_PATH));
}