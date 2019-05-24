<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @package     daycarepro app
 * @copyright   2018 A&M Digital Technologies
 * @author      John Muchiri
 * @link        https://amdtllc.com
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */
class Files extends CI_Controller{
    function __construct() {
        parent::__construct();
        setRedirect();
        auth(true);

        $this->load->helper('files');
        $this->module='files/';

    }
    function index($daycare_id = NULL){       
        dashboard_page($this->module.'cabinet',$data=[],$daycare_id);
    }

    function upload(){
        // get path
        $upload_path = './assets/uploads/files';
        $p = isset($_GET['p']) ? $_GET['p'] : (isset($_POST['p']) ? $_POST['p'] : '');
        $p = fm_clean_path($p);        
        $path=$upload_path;

        if($p != '') {
            $path .= '/'.$p;
        }

        if(!file_exists($path)) {
            mkdir($path, 755, true);
        }
        $config = array(
            'upload_path' => $path,
            'allowed_types' => 'png|txt|gif|jpg|jpeg|pdf|doc|docx|xls|xlsx|ppt|pptx|ogg|mp3|mov|mp4',
            'max_size' => '3048',
            'encrypt_name' => false,
        );
        $this->load->library('upload', $config);
        if(!$this->upload->do_upload('file')) {
            $msg = lang('request_error');
            $type = 'error';
        } else {
            $upload_data = $this->upload->data();

            if($upload_data) {
                $msg = lang('request_success');
                $type = 'success';
            } else {
                $msg = lang('request_error');
                $type = 'error';
            }
        }
        return json_encode($msg, $type);
    }
}
?>