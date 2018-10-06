<?php
// Unpack
if(isset($_GET['unzip']) && !FM_READONLY && session('company_demo_mode') !==1) {
    $unzip = $_GET['unzip'];
    $unzip = fm_clean_path($unzip);
    $unzip = str_replace('/', '', $unzip);

    $path = FM_ROOT_PATH;
    if(FM_PATH != '') {
        $path .= '/'.FM_PATH;
    }

    if(!class_exists('ZipArchive')) {
        fm_set_msg('Operations with archives are not available', 'error');
        fm_redirect(FM_SELF_URL.'?p='.urlencode(FM_PATH));
    }

    if($unzip != '' && is_file($path.'/'.$unzip)) {
        $zip_path = $path.'/'.$unzip;

        //to folder
        $tofolder = '';
        if(isset($_GET['tofolder'])) {
            $tofolder = pathinfo($zip_path, PATHINFO_FILENAME);
            if(fm_mkdir($path.'/'.$tofolder, true)) {
                $path .= '/'.$tofolder;
            }
        }

        $zipper = new FM_Zipper();
        $res = $zipper->unzip($zip_path, $path);

        if($res) {
            fm_set_msg('Archive unpacked');
        } else {
            fm_set_msg('Archive not unpacked', 'error');
        }

    } else {
        fm_set_msg('File not found', 'error');
    }
    fm_redirect(FM_SELF_URL.'?p='.urlencode(FM_PATH));
}
?>