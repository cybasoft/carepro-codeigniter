<?php
// file viewer
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
?>