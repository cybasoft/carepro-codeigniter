<?php

// Pack files
if(isset($_POST['group'], $_POST['zip']) && !FM_READONLY && session('company_demo_mode') !==1) {
    $path = FM_ROOT_PATH;
    if(FM_PATH != '') {
        $path .= '/'.FM_PATH;
    }

    if(!class_exists('ZipArchive')) {
        fm_set_msg('Operations with archives are not available', 'error');
        fm_redirect(FM_SELF_URL.'?p='.urlencode(FM_PATH));
    }

    $files = $_POST['file'];
    if(!empty($files)) {
        chdir($path);

        if(count($files) == 1) {
            $one_file = reset($files);
            $one_file = basename($one_file);
            $zipname = $one_file.'_'.date('ymd_His').'.zip';
        } else {
            $zipname = 'archive_'.date('ymd_His').'.zip';
        }

        $zipper = new FM_Zipper();
        $res = $zipper->create($zipname, $files);

        if($res) {
            fm_set_msg(sprintf('Archive <b>%s</b> created', fm_enc($zipname)));
        } else {
            fm_set_msg('Archive not created', 'error');
        }
    } else {
        fm_set_msg('Nothing selected', 'alert');
    }

    fm_redirect(FM_SELF_URL.'?p='.urlencode(FM_PATH));
}
?>