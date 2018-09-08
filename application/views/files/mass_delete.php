<?php

// Mass deleting
if(isset($_POST['group'], $_POST['delete']) && !FM_READONLY) {
    $path = FM_ROOT_PATH;
    if(FM_PATH != '') {
        $path .= '/'.FM_PATH;
    }

    $errors = 0;
    $files = $_POST['file'];
    if(is_array($files) && count($files)) {
        foreach ($files as $f) {
            if($f != '') {
                $new_path = $path.'/'.$f;
                if(!fm_rdelete($new_path)) {
                    $errors++;
                }
            }
        }
        if($errors == 0) {
            fm_set_msg('Selected files and folder deleted');
        } else {
            fm_set_msg('Error while deleting items', 'error');
        }
    } else {
        fm_set_msg('Nothing selected', 'alert');
    }

    fm_redirect(FM_SELF_URL.'?p='.urlencode(FM_PATH));
}
?>