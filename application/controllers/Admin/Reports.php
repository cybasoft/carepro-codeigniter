<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Reports extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        //redirect session
        $this->conf->setRedirect();

		$this->conf->allow('super');

        //variables
        $this->load->model('My_reports','reports');
        $this->module= 'modules/admin/backup/';
    }

    public function index()
    {
        $data = array(
            'tables_list'=>$this->reports->get_table_list(),
            'sql_backups'=>$this->reports->result_sql('select * from backup_sql'),
            'csv_backups'=>$this->reports->result_sql('select * from backup_csv')
        );
        $this->conf->page($this->module.'index', $data);
    }

    public function create_backup_file()
    {
        $this->form_validation->set_rules('tablename', lang('table_name'), 'required');
        if ($this->form_validation->run() == true) {
            $this->load->dbutil();
            $query        = $this->db->query("SELECT * FROM " . $this->input->post('tablename'));
            $file_content = $this->dbutil->csv_from_result($query);

            $file_name = $this->input->post('tablename');

            $fp        = fopen("./assets/backups/csv/" . strtotime('now') . ".csv", "wb");
            fwrite($fp, $file_content);
            fclose($fp);

            $data = array(
                'backup_path' => $file_name . ".csv",
                'backup_date' => strtotime('now')
            );
            $this->reports->add_record_id('backup_csv', $data);
        }else{
            $this->conf->msg('danger',lang('request_error'));
        }
        redirect('reports#tables_csv');
    }

    function backup_db()
    {
        // Load the DB utility class
        $this->load->dbutil();

        $tablename = $this->reports->get_table_list();

        $prefs = array(
            'tables'     => $tablename, // Array of tables to backup.
            'ignore'     => array(), // List of tables to omit from the backup
            'format'     => 'txt', // gzip, zip, txt
            'filename'   => 'mybackup.sql', // File name - NEEDED ONLY WITH ZIP FILES
            'add_drop'   => TRUE, // Whether to add DROP TABLE statements to backup file
            'add_insert' => TRUE, // Whether to add INSERT data to backup file
            'newline'    => "\n" // Newline character used in backup file
        );

        $backup = $this->dbutil->backup($prefs);

        $file_name = strtotime('now');
        $fp        = fopen("./assets/backups/" . $file_name . ".sql", "wb");
        fwrite($fp, $backup);
        fclose($fp);

        $data = array(
            'backup_path' => $file_name . ".sql",
            'backup_date' => $file_name
        );
        if($this->reports->add_record_id('backup_sql', $data)){
            $this->conf->msg('success',lang('request_success'));
        }else{
            $this->conf->msg('danger',lang('request_error'));
        }
        redirect('reports#backup_db');

    }

    /*
     * clear backup tables
     */
    function delete_csv_backup($id){
        if($this->conf->isAdmin() && $id !==""){
            $this->db->where('id',$id);
            $query = $this->db->get('backup_csv');
            foreach($query->result() as $row){
                if(unlink("./assets/backups/csv/" . $row->backup_date.'.csv')){
                    $this->db->where('id',$id);
                    if($this->db->delete('backup_csv')){
                        $this->conf->msg('success',lang('request_success'));
                    }else{
                        $this->conf->msg('danger',lang('request_error'));
                    }
                }else{
                    $this->conf->msg('danger',lang('file_not_found'));
                }

            }
        }else{
            $this->conf->msg('danger',lang('request_error'));
        }
        redirect('reports#tables_csv');
    }

    /*
     * clear database backups
     */
    function delete_sql_backup($id){
        if($this->conf->isAdmin() && $id !==""){
        $this->db->where('id',$id);
        $query = $this->db->get('backup_sql');
        foreach($query->result() as $row){
            if(unlink("./assets/backups/" . $row->backup_path)){
                $this->db->where('id',$id);
                if($this->db->delete('backup_sql')){
                    $this->conf->msg('success',lang('request_success'));
                }else{
                    $this->conf->msg('danger',lang('request_error'));
                }
            }else{
                $this->conf->msg('danger',lang('file_not_found'));
            }

        }
        }else{
            $this->conf->msg('danger',lang('request_error'));
        }
       redirect('reports#backup_db');
    }
}

