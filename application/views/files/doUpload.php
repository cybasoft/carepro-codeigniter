<?php

// Upload
if(!empty($_FILES) && !FM_READONLY) {
    $f = $_FILES;
    $path = FM_ROOT_PATH;
    if(FM_PATH != '') {
        $path .= '/'.FM_PATH;
    }

    $errors = 0;
    $uploads = 0;
    $total = count($f['file']['name']);
    $allowed = (FM_EXTENSION) ? explode(',', FM_EXTENSION) : false;

    $filename = $f['file']['name'];
    $tmp_name = $f['file']['tmp_name'];
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    $isFileAllowed = ($allowed) ? in_array($ext, $allowed) : true;

    if(empty($f['file']['error']) && !empty($tmp_name) && $tmp_name != 'none' && $isFileAllowed) {
        if(move_uploaded_file($tmp_name, $path.'/'.$f['file']['name'])) {
            die('Successfully uploaded');
        } else {
            die(sprintf('Error while uploading files. Uploaded files: %s', $uploads));
        }
    }
    exit();
}
?>