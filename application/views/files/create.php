<?php

if(isset($_GET['new']) && isset($_GET['type']) && !FM_READONLY && session('company_demo_mode') !==1) {
    allow(['admin','manager','staff']);
    $new = strip_tags($_GET['new']);
    $type = $_GET['type'];
    $new = fm_clean_path($new);
    $new = str_replace('/', '', $new);
    if($new != '' && $new != '..' && $new != '.') {
        $path = FM_ROOT_PATH;
        if(FM_PATH != '') {
            $path .= '/'.FM_PATH;
        }
        if($_GET['type'] == "file") {
            if(!file_exists($path.'/'.$new)) {
                @fopen($path.'/'.$new, 'w') or die('Cannot open file:  '.$new);
                fm_set_msg(sprintf('File <b>%s</b> created', fm_enc($new)));
            } else {
                fm_set_msg(sprintf('File <b>%s</b> already exists', fm_enc($new)), 'alert');
            }
        } else {
            if(fm_mkdir($path.'/'.$new, false) === true) {
                fm_set_msg(sprintf('Folder <b>%s</b> created', $new));
            } elseif(fm_mkdir($path.'/'.$new, false) === $path.'/'.$new) {
                fm_set_msg(sprintf('Folder <b>%s</b> already exists', fm_enc($new)), 'alert');
            } else {
                fm_set_msg(sprintf('Folder <b>%s</b> not created', fm_enc($new)), 'error');
            }
        }
    } else {
        fm_set_msg('Wrong folder name', 'error');
    }
    fm_redirect(FM_SELF_URL.'?p='.urlencode(FM_PATH));
}