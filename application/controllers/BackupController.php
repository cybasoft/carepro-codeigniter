<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @package     carepro app
 * @copyright   2018 A&M Digital Technologies
 * @author      John Muchiri
 * @link        https://amdtllc.com
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */
class BackupController extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        auth(true);
        allow('admin');
        $this->module = 'admin/';
        $this->load->model('My_backup', 'backup');
        $this->title = lang('Backup');
    }


    function download()
    {
        $id = $this->uri->segment(4);
        $this->load->helper('download');
        $file = file_get_contents(APPPATH.'../assets/uploads/backups/'.$id);
        force_download($id, $file);
    }

    public function create_csv()
    {
        $this->form_validation->set_rules('tablename', lang('table_name'), 'required');
        if($this->form_validation->run() == true) {
            if($this->backup->create_table_csv()) {
                flash('success', lang('request_success'));
            } else {
                flash('error', lang('request_error'));
            }
        } else {
            flash('danger');
            validation_errors();
        }
        redirectPrev('', 'backup');
    }

    function backup_db()
    {
        $this->backup->backup_db();
        redirectPrev('', 'backup');
    }

    /*
     * clear backup tables
     */
    function delete_backup()
    {
        $this->backup->delete_backup($this->uri->segment(4));
        redirectPrev('', 'backup');
    }

}