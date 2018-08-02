<?php

// Readonly users (usernames array)
$readonly_users = array(
    'staff'
);

// allowed upload file extensions
$upload_extensions = 'png,txt,gif,jpg,jpeg,pdf,doc,docx,xls,xlsx,ppt,pptx,ogg,mp3,mov,mp4'; // 'gif,png,jpg'

// Show or hide files and folders that starts with a dot
$show_hidden_files = true;

// Enable highlight.js (https://highlightjs.org/) on view's page
$use_highlightjs = true;

// highlight.js style
$highlightjs_style = 'vs';

// Send files though mail
$toMailId = ""; //yourmailid@mail.com

// Default timezone for date() and time() - http://php.net/manual/en/timezones.php
$default_timezone = 'Etc/UTC'; // UTC

// Root path for file manager
$root_path = $_SERVER['DOCUMENT_ROOT'].'/assets/uploads/files';

// Root url for links in file manager.Relative to $http_host. Variants: '', 'path/to/subfolder'
// Will not working if $root_path will be outside of server document root
$root_url = '';

// Server hostname. Can set manually if wrong
$http_host = $_SERVER['HTTP_HOST'];

// input encoding for iconv
$iconv_input_encoding = 'UTF-8';

// date() format for file modification date
$datetime_format = 'd.m.y H:i';

// show or hide the left side tree view
$show_tree_view = false;

//Array of folders excluded from listing
$GLOBALS['exclude_folders'] = array();

// include user config php file
if(defined('FM_CONFIG') && is_file(FM_CONFIG)) {
    include(FM_CONFIG);
}

$current_user = "admin";

$is_https = isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1)
    || isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https';

// clean and check $root_path
$root_path = rtrim($root_path, '\\/');
$root_path = str_replace('\\', '/', $root_path);
if(!@is_dir($root_path)) {
    echo "<h1>Root path \"{$root_path}\" not found!</h1>";
    exit;
}

// clean $root_url
$root_url = fm_clean_path($root_url);

// abs path for site
defined('FM_SHOW_HIDDEN') || define('FM_SHOW_HIDDEN', $show_hidden_files);
defined('FM_ROOT_PATH') || define('FM_ROOT_PATH', $root_path);
defined('FM_ROOT_URL') || define('FM_ROOT_URL', ($is_https ? 'https' : 'http').'://'.$http_host.(!empty($root_url) ? '/'.$root_url : ''));

defined('FM_SELF_URL') || define('FM_SELF_URL', uri_string());

// Show image here
if(isset($_GET['img'])) {
    fm_show_image($_GET['img']);
}

defined('FM_EXTENSION') || define('FM_EXTENSION', $upload_extensions);
defined('FM_TREEVIEW') || define('FM_TREEVIEW', $show_tree_view);
define('FM_READONLY', !empty($readonly_users) && in_array($current_user, $readonly_users));
define('FM_IS_WIN', DIRECTORY_SEPARATOR == '\\');

// always use ?p=
if(!isset($_GET['p']) && empty($_FILES)) {
    fm_redirect(FM_SELF_URL.'?p=');
}

// get path
$p = isset($_GET['p']) ? $_GET['p'] : (isset($_POST['p']) ? $_POST['p'] : '');

// clean path
$p = fm_clean_path($p);

// instead globals vars
define('FM_PATH', $p);

defined('FM_ICONV_INPUT_ENC') || define('FM_ICONV_INPUT_ENC', $iconv_input_encoding);
defined('FM_USE_HIGHLIGHTJS') || define('FM_USE_HIGHLIGHTJS', $use_highlightjs);
defined('FM_HIGHLIGHTJS_STYLE') || define('FM_HIGHLIGHTJS_STYLE', $highlightjs_style);
defined('FM_DATETIME_FORMAT') || define('FM_DATETIME_FORMAT', $datetime_format);

unset($p, $iconv_input_encoding, $use_highlightjs, $highlightjs_style);

/*************************** ACTIONS ***************************/

//AJAX Request
if(isset($_POST['ajax']) && !FM_READONLY) {

    //search : get list of files from the current folder
    if(isset($_POST['type']) && $_POST['type'] == "search") {
        $dir = $_POST['path'];
        $response = scan($dir);
        echo json_encode($response);
    }

    //backup files
    if(isset($_POST['type']) && $_POST['type'] == "backup") {
        $file = $_POST['file'];
        $path = $_POST['path'];
        $date = date("dMy-His");
        $newFile = $file.'-'.$date.'.bak';
        copy($path.'/'.$file, $path.'/'.$newFile) or die("Unable to backup");
        echo "Backup $newFile Created";
    }

    exit;
}

// Delete file / folder
if(isset($_GET['del']) && !FM_READONLY) {
    $del = $_GET['del'];
    $del = fm_clean_path($del);
    $del = str_replace('/', '', $del);
    if($del != '' && $del != '..' && $del != '.') {
        $path = FM_ROOT_PATH;
        if(FM_PATH != '') {
            $path .= '/'.FM_PATH;
        }
        $is_dir = is_dir($path.'/'.$del);
        if(fm_rdelete($path.'/'.$del)) {
            $msg = $is_dir ? 'Folder <b>%s</b> deleted' : 'File <b>%s</b> deleted';
            fm_set_msg(sprintf($msg, fm_enc($del)));
        } else {
            $msg = $is_dir ? 'Folder <b>%s</b> not deleted' : 'File <b>%s</b> not deleted';
            fm_set_msg(sprintf($msg, fm_enc($del)), 'error');
        }
    } else {
        fm_set_msg('Wrong file or folder name', 'error');
    }
    fm_redirect(FM_SELF_URL.'?p='.urlencode(FM_PATH));
}

// Create folder
if(isset($_GET['new']) && isset($_GET['type']) && !FM_READONLY) {
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

// Copy folder / file
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

// Rename
if(isset($_GET['ren'], $_GET['to']) && !FM_READONLY) {
    // old name
    $old = $_GET['ren'];
    $old = fm_clean_path($old);
    $old = str_replace('/', '', $old);
    // new name
    $new = $_GET['to'];
    $new = fm_clean_path($new);
    $new = str_replace('/', '', $new);
    // path
    $path = FM_ROOT_PATH;
    if(FM_PATH != '') {
        $path .= '/'.FM_PATH;
    }
    // rename
    if($old != '' && $new != '') {
        if(fm_rename($path.'/'.$old, $path.'/'.$new)) {
            fm_set_msg(sprintf('Renamed from <b>%s</b> to <b>%s</b>', fm_enc($old), fm_enc($new)));
        } else {
            fm_set_msg(sprintf('Error while renaming from <b>%s</b> to <b>%s</b>', fm_enc($old), fm_enc($new)), 'error');
        }
    } else {
        fm_set_msg('Names not set', 'error');
    }
    fm_redirect(FM_SELF_URL.'?p='.urlencode(FM_PATH));
}

// Download
if(isset($_GET['dl'])) {
    $dl = $_GET['dl'];
    $dl = fm_clean_path($dl);
    $dl = str_replace('/', '', $dl);
    $path = FM_ROOT_PATH;
    if(FM_PATH != '') {
        $path .= '/'.FM_PATH;
    }
    if($dl != '' && is_file($path.'/'.$dl)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.basename($path.'/'.$dl).'"');
        header('Content-Transfer-Encoding: binary');
        header('Connection: Keep-Alive');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-Length: '.filesize($path.'/'.$dl));
        readfile($path.'/'.$dl);
        exit;
    } else {
        fm_set_msg('File not found', 'error');
        fm_redirect(FM_SELF_URL.'?p='.urlencode(FM_PATH));
    }
}

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

// Pack files
if(isset($_POST['group'], $_POST['zip']) && !FM_READONLY) {
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

// Unpack
if(isset($_GET['unzip']) && !FM_READONLY) {
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

/*************************** /ACTIONS ***************************/

// get current path
$path = FM_ROOT_PATH;
if(FM_PATH != '') {
    $path .= '/'.FM_PATH;
}

// check path
if(!is_dir($path)) {
    fm_redirect(FM_SELF_URL.'?p=');
}

// get parent folder
$parent = fm_get_parent_path(FM_PATH);

$objects = is_readable($path) ? scandir($path) : array();
$folders = array();
$files = array();
if(is_array($objects)) {
    foreach ($objects as $file) {
        if($file == '.' || $file == '..' && in_array($file, $GLOBALS['exclude_folders'])) {
            continue;
        }
        if(!FM_SHOW_HIDDEN && substr($file, 0, 1) === '.') {
            continue;
        }
        $new_path = $path.'/'.$file;
        if(is_file($new_path)) {
            $files[] = $file;
        } elseif(is_dir($new_path) && $file != '.' && $file != '..' && !in_array($file, $GLOBALS['exclude_folders'])) {
            $folders[] = $file;
        }
    }
}

if(!empty($files)) {
    natcasesort($files);
}
if(!empty($folders)) {
    natcasesort($folders);
}

// upload form
if(isset($_GET['upload']) && !FM_READONLY) {
    fm_show_header(); // HEADER
    fm_show_nav_path(FM_PATH); // current path
    ?>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.js"></script>

    <div class="path">
        <p class="break-word label label-default"><?php echo lang('Uploading to').' '.fm_enc(fm_convert_win('/'.FM_PATH)) ?></p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]).'?p='.fm_enc(FM_PATH) ?>" class="dropzone"
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

$this->load->view($this->module.'copy');

// file viewer
if(isset($_GET['view'])) {
    $file = $_GET['view'];
    $file = fm_clean_path($file);
    $file = str_replace('/', '', $file);
    if($file == '' || !is_file($path.'/'.$file)) {
        fm_set_msg('File not found', 'error');
        fm_redirect(FM_SELF_URL.'?p='.urlencode(FM_PATH));
    }

    fm_show_header(); // HEADER
    fm_show_nav_path(FM_PATH); // current path

    $file_url = FM_ROOT_URL.fm_convert_win((FM_PATH != '' ? '/'.FM_PATH : '').'/'.$file);
    $file_path = $path.'/'.$file;

    $ext = strtolower(pathinfo($file_path, PATHINFO_EXTENSION));
    $mime_type = fm_get_mime_type($file_path);
    $filesize = filesize($file_path);

    $is_zip = false;
    $is_image = false;
    $is_audio = false;
    $is_video = false;
    $is_text = false;

    $view_title = 'File';
    $filenames = false; // for zip
    $content = ''; // for text

    if($ext == 'zip') {
        $is_zip = true;
        $view_title = 'Archive';
        $filenames = fm_get_zif_info($file_path);
    } elseif(in_array($ext, fm_get_image_exts())) {
        $is_image = true;
        $view_title = 'Image';
    } elseif(in_array($ext, fm_get_audio_exts())) {
        $is_audio = true;
        $view_title = 'Audio';
    } elseif(in_array($ext, fm_get_video_exts())) {
        $is_video = true;
        $view_title = 'Video';
    } elseif(in_array($ext, fm_get_text_exts()) || substr($mime_type, 0, 4) == 'text' || in_array($mime_type, fm_get_text_mimes())) {
        $is_text = true;
        $content = file_get_contents($file_path);
    }

    ?>
    <div class="path">
        <p class="break-word"><b><?php echo $view_title ?> "<?php echo fm_enc(fm_convert_win($file)) ?>"</b></p>
        <p class="break-word">
            Full path: <?php echo fm_enc(fm_convert_win($file_path)) ?><br>
            File
            size: <?php echo fm_get_filesize($filesize) ?><?php if($filesize >= 1000): ?> (<?php echo sprintf('%s bytes', $filesize) ?>)<?php endif; ?>
            <br>
            MIME-type: <?php echo $mime_type ?><br>
            <?php
            // ZIP info
            if($is_zip && $filenames !== false) {
                $total_files = 0;
                $total_comp = 0;
                $total_uncomp = 0;
                foreach ($filenames as $fn) {
                    if(!$fn['folder']) {
                        $total_files++;
                    }
                    $total_comp += $fn['compressed_size'];
                    $total_uncomp += $fn['filesize'];
                }
                ?>
                Files in archive: <?php echo $total_files ?><br>
                Total size: <?php echo fm_get_filesize($total_uncomp) ?><br>
                Size in archive: <?php echo fm_get_filesize($total_comp) ?><br>
                Compression: <?php echo round(($total_comp / 1) * 100) ?>%<br>
                <?php
            }
            // Image info
            if($is_image) {
                $image_size = getimagesize($file_path);
                echo 'Image sizes: '.(isset($image_size[0]) ? $image_size[0] : '0').' x '.(isset($image_size[1]) ? $image_size[1] : '0').'<br>';
            }
            // Text info
            if($is_text) {
                $is_utf8 = fm_is_utf8($content);
                if(function_exists('iconv')) {
                    if(!$is_utf8) {
                        $content = iconv(FM_ICONV_INPUT_ENC, 'UTF-8//IGNORE', $content);
                    }
                }
                echo 'Charset: '.($is_utf8 ? 'utf-8' : '8 bit').'<br>';
            }
            ?>
        </p>
        <p>
            <b><a href="?p=<?php echo urlencode(FM_PATH) ?>&amp;dl=<?php echo urlencode($file) ?>"><i
                            class="fa fa-cloud-download"></i> <?php echo lang('Download'); ?></a></b> &nbsp;
            <strong>
                <a href="<?php echo fm_enc($file_url) ?>" target="_blank"><i class="fa fa-external-link-square"></i>
                    <?php echo lang('Open'); ?></a>
            </strong>
            &nbsp;
            <?php
            // ZIP actions
            if(!FM_READONLY && $is_zip && $filenames !== false) {
                $zip_name = pathinfo($file_path, PATHINFO_FILENAME);
                ?>
                <b><a href="?p=<?php echo urlencode(FM_PATH) ?>&amp;unzip=<?php echo urlencode($file) ?>"><i
                                class="fa fa-check-circle"></i> UnZip</a></b> &nbsp;
                <b><a href="?p=<?php echo urlencode(FM_PATH) ?>&amp;unzip=<?php echo urlencode($file) ?>&amp;tofolder=1"
                      title="UnZip to <?php echo fm_enc($zip_name) ?>"><i class="fa fa-check-circle"></i>
                        <?php echo lang('UnZip to folder'); ?></a></b> &nbsp;
                <?php
            }
            ?>

            <strong><a href="?p=<?php echo urlencode(FM_PATH) ?>"><i class="fa fa-chevron-circle-left"></i>
                    <?php echo lang('Back'); ?></a>
            </strong>
        </p>
        <?php
        if($is_zip) {
            // ZIP content
            if($filenames !== false) {
                echo '<code class="maxheight">';
                foreach ($filenames as $fn) {
                    if($fn['folder']) {
                        echo '<b>'.fm_enc($fn['name']).'</b><br>';
                    } else {
                        echo $fn['name'].' ('.fm_get_filesize($fn['filesize']).')<br>';
                    }
                }
                echo '</code>';
            } else {
                echo '<p>Error while fetching archive info</p>';
            }
        } elseif($is_image) {
            // Image content
            if(in_array($ext, array('gif', 'jpg', 'jpeg', 'png', 'bmp', 'ico'))) {
                echo '<p><img src="'.fm_enc($file_url).'" alt="" class="preview-img"></p>';
            }
        } elseif($is_audio) {
            // Audio content
            echo '<p><audio src="'.fm_enc($file_url).'" controls preload="metadata"></audio></p>';
        } elseif($is_video) {
            // Video content
            echo '<div class="preview-video"><video src="'.fm_enc($file_url).'" width="640" height="360" controls preload="metadata"></video></div>';
        } elseif($is_text) {
            if(FM_USE_HIGHLIGHTJS) {
                // highlight
                $hljs_classes = array(
                    'shtml' => 'xml',
                    'htaccess' => 'apache',
                    'phtml' => 'php',
                    'lock' => 'json',
                    'svg' => 'xml',
                );
                $hljs_class = isset($hljs_classes[$ext]) ? 'lang-'.$hljs_classes[$ext] : 'lang-'.$ext;
                if(empty($ext) || in_array(strtolower($file), fm_get_text_names()) || preg_match('#\.min\.(css|js)$#i', $file)) {
                    $hljs_class = 'nohighlight';
                }
                $content = '<pre class="with-hljs"><code class="'.$hljs_class.'">'.fm_enc($content).'</code></pre>';
            } elseif(in_array($ext, array('php', 'php4', 'php5', 'phtml', 'phps'))) {
                // php highlight
                $content = highlight_string($content, true);
            } else {
                $content = '<pre>'.fm_enc($content).'</pre>';
            }
            echo $content;
        }
        ?>
    </div>
    <?php
    fm_show_footer();
    exit;
}

fm_show_header(); // HEADER
fm_show_nav_path(FM_PATH); // current path

// messages
if(isset($_SESSION['message'])) {
    $class = isset($_SESSION['status']) ? $_SESSION['status'] : 'ok';
    echo '<p class="message '.$class.'">'.$_SESSION['message'].'</p>';
    unset($_SESSION['message']);
    unset($_SESSION['status']);
}

$num_files = count($files);
$num_folders = count($folders);
$all_files_size = 0;
?>
<form action="" method="post">
    <input type="hidden" name="p" value="<?php echo fm_enc(FM_PATH) ?>">
    <input type="hidden" name="group" value="1">
    <?php if(FM_TREEVIEW) { ?>
        <div class="file-tree-view" id="file-tree-view">
            <div class="tree-title"><?php echo lang('Browse'); ?></div>
            <?php
            //file tre view
            echo php_file_tree($_SERVER['DOCUMENT_ROOT'], "javascript:alert('You clicked on [link]');");
            ?>
        </div>
    <?php } ?>
    <table class="table" id="main-table">
        <?php if($parent !== false): ?>
            <tr>
                <td colspan="7">
                    <a href="?p=<?php echo urlencode($parent) ?>">
                        <i class="fa fa-chevron-circle-left"></i> ..
                    </a>
                </td>
            </tr>
        <?php endif; ?>

        <thead>
        <tr>
            <?php if(!FM_READONLY): ?>
                <th style="width:3%">
                    <label><input type="checkbox" title="Invert selection" onclick="checkbox_toggle()"></label>
                </th>
            <?php endif; ?>
            <th><?php echo lang('Name'); ?></th>
            <th style="width:10%"><?php echo lang('Size'); ?></th>
            <th style="width:12%"><?php echo lang('Modified'); ?></th>
            <th colspan="3"
                style="width:<?php if(!FM_READONLY): ?>13<?php else: ?>6.5<?php endif; ?>%"><?php echo lang('Actions'); ?></th>
        </tr>
        </thead>
        <?php
        foreach ($folders as $f) {
            $is_link = is_link($path.'/'.$f);
            $img = $is_link ? 'icon-link_folder' : 'fa fa-folder-o';
            $modif = date(FM_DATETIME_FORMAT, filemtime($path.'/'.$f));
            ?>
            <tr>
                <?php if(!FM_READONLY): ?>
                    <td><label><input type="checkbox" name="file[]" value="<?php echo fm_enc($f) ?>"></label></td>
                <?php endif; ?>
                <td>
                    <div class="filename">
                        <a href="?p=<?php echo urlencode(trim(FM_PATH.'/'.$f, '/')) ?>">
                            <i class="<?php echo $img ?>"></i> <?php echo fm_convert_win($f) ?>
                        </a>
                        <?php echo($is_link ? ' &rarr; <i>'.readlink($path.'/'.$f).'</i>' : '') ?>
                    </div>
                </td>
                <td><?php echo lang('Folder'); ?></td>
                <td><?php echo $modif ?></td>
                <td class="inline-actions">
                    <?php if(!FM_READONLY): ?>
                        <a title="Delete" class="text-danger"
                           href="?p=<?php echo urlencode(FM_PATH) ?>&amp;del=<?php echo urlencode($f) ?>"
                           onclick="return confirm('Delete folder?');">
                            <i class="fa fa-trash-alt" aria-hidden="true"></i>
                        </a>
                        <a title="Rename" href="#" class=" text-info"
                           onclick="rename('<?php echo fm_enc(FM_PATH) ?>', '<?php echo fm_enc($f) ?>');return false;">
                            <i class="fa fa-pencil-alt" aria-hidden="true"></i>
                        </a>
                        <a title="Copy to..." href="?p=&amp;copy=<?php echo urlencode(trim(FM_PATH.'/'.$f, '/')) ?>">
                            <i class="fa fa-copy" aria-hidden="true"></i>
                        </a>
                    <?php endif; ?>
                    <a title="Direct link"
                       href="<?php echo fm_enc(FM_ROOT_URL.(FM_PATH != '' ? '/'.FM_PATH : '').'/'.$f.'/') ?>"
                       target="_blank">
                        <i class="fa fa-link" aria-hidden="true"></i>
                    </a>
                </td>
            </tr>
            <?php
            flush();
        }

        foreach ($files as $f) {
            $is_link = is_link($path.'/'.$f);
            $img = $is_link ? 'fa fa-file-text-o' : fm_get_file_icon_class($path.'/'.$f);
            $modif = date(FM_DATETIME_FORMAT, filemtime($path.'/'.$f));
            $filesize_raw = filesize($path.'/'.$f);
            $filesize = fm_get_filesize($filesize_raw);
            $filelink = '?p='.urlencode(FM_PATH).'&amp;view='.urlencode($f);
            $all_files_size += $filesize_raw;

            ?>
            <tr>
                <?php if(!FM_READONLY): ?>
                    <td><label><input type="checkbox" name="file[]" value="<?php echo fm_enc($f) ?>"></label>
                    </td><?php endif; ?>
                <td>
                    <div class="filename"><a href="<?php echo $filelink ?>" title="File info"><i
                                    class="<?php echo $img ?>"></i> <?php echo fm_convert_win($f) ?>
                        </a><?php echo($is_link ? ' &rarr; <i>'.readlink($path.'/'.$f).'</i>' : '') ?></div>
                </td>
                <td><span title="<?php printf('%s bytes', $filesize_raw) ?>"><?php echo $filesize ?></span></td>
                <td><?php echo $modif ?></td>
                <td class="inline-actions">
                    <?php if(!FM_READONLY): ?>
                        <a title="Delete" href="?p=<?php echo urlencode(FM_PATH) ?>&amp;del=<?php echo urlencode($f) ?>"
                           onclick="return confirm('Delete file?');"><i class="fa fa-trash-o"></i></a>
                        <a title="Rename" href="#"
                           onclick="rename('<?php echo fm_enc(FM_PATH) ?>', '<?php echo fm_enc($f) ?>');return false;"><i
                                    class="fa fa-pencil-square-o"></i></a>
                        <a title="Copy to..."
                           href="?p=<?php echo urlencode(FM_PATH) ?>&amp;copy=<?php echo urlencode(trim(FM_PATH.'/'.$f, '/')) ?>"><i
                                    class="fa fa-files-o"></i></a>
                    <?php endif; ?>
                    <a title="Direct link"
                       href="<?php echo fm_enc(FM_ROOT_URL.(FM_PATH != '' ? '/'.FM_PATH : '').'/'.$f) ?>"
                       target="_blank"><i class="fa fa-link"></i></a>
                    <a title="Download" href="?p=<?php echo urlencode(FM_PATH) ?>&amp;dl=<?php echo urlencode($f) ?>"><i
                                class="fa fa-download"></i></a>
                </td>
            </tr>
            <?php
            flush();
        }

        if(empty($folders) && empty($files)) {
            ?>
            <tr><?php if(!FM_READONLY): ?>
                    <td></td><?php endif; ?>
                <td colspan="<?php echo !FM_IS_WIN ? '6' : '4' ?>"><em><?php echo 'Folder is empty' ?></em></td>
            </tr>
            <?php
        } else {
            ?>
            <tr><?php if(!FM_READONLY): ?>
                    <td class="gray"></td><?php endif; ?>
                <td class="gray" colspan="<?php echo !FM_IS_WIN ? '6' : '4' ?>">
                    <?php echo lang('Full size'); ?>: <span
                            title="<?php printf('%s bytes', $all_files_size) ?>"><?php echo fm_get_filesize($all_files_size) ?></span>,
                    <?php echo lang('Files'); ?>: <?php echo $num_files ?>,
                    <?php echo lang('Folders').': '.$num_folders ?>
                </td>
            </tr>
            <?php
        }
        ?>
    </table>
    <?php if(!FM_READONLY): ?>
    <p class="path footer-links"><a href="#/select-all" class="group-btn" onclick="select_all();return false;"><i
                    class="fa fa-check-square"></i> <?php echo lang('Select all'); ?></a> &nbsp;
        <a href="#/unselect-all" class="group-btn" onclick="unselect_all();return false;"><i
                    class="fa fa-window-close"></i> <?php echo lang('Unselect all'); ?></a> &nbsp;
        <a href="#/invert-all" class="group-btn" onclick="invert_all();return false;"><i class="fa fa-th-list"></i>
            <?php echo lang('Invert selection'); ?></a> &nbsp;
        <input type="submit" class="hidden" name="delete" id="a-delete" value="Delete"
               onclick="return confirm('Delete selected files and folders?')">
        <a href="javascript:document.getElementById('a-delete').click();" class="group-btn"><i class="fa fa-trash"></i>
            <?php echo lang('Delete'); ?> </a> &nbsp;
        <input type="submit" class="hidden" name="zip" id="a-zip" value="Zip"
               onclick="return confirm('Create archive?')">
        <a href="javascript:document.getElementById('a-zip').click();" class="group-btn"><i
                    class="fa fa-file-archive-o"></i> <?php echo lang('Zip'); ?> </a> &nbsp;
        <input type="submit" class="hidden" name="copy" id="a-copy" value="Copy">
        <a href="javascript:document.getElementById('a-copy').click();" class="group-btn"><i class="fa fa-files-o"></i>
            <?php echo lang('Copy'); ?> </a>
        <?php endif; ?>
</form>

<?php fm_show_footer(); ?>
