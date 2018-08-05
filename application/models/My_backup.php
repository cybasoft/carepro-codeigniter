<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class My_backup extends CI_Model
{

    function backup_db()
    {
        // Load the DB utility class
        $this->load->dbutil();

        $tablename = $this->backup->tablesList();

        $prefs = array(
            'tables' => $tablename, // Array of tables to backup.
            'ignore' => array(), // List of tables to omit from the backup
            'format' => 'txt', // gzip, zip, txt
            'filename' => 'mybackup.sql', // File name - NEEDED ONLY WITH ZIP FILES
            'add_drop' => TRUE, // Whether to add DROP TABLE statements to backup file
            'add_insert' => TRUE, // Whether to add INSERT data to backup file
            'newline' => "\n" // Newline character used in backup file
        );

        $backup = $this->dbutil->backup($prefs);

        $file_name =date('Y-m-d_H-i').'-backup-'. strtotime('now');
        $fp = fopen(APPPATH.'../assets/uploads/backups/'.$file_name.'.sql', "wb");
        fwrite($fp, $backup);
        fclose($fp);

        $data = array(
            'name' => $file_name.".sql",
            'created_at' => date_stamp()
        );

        if($this->add_record_id('db_backup', $data))
            return true;

        return false;
    }

    function create_table_csv()
    {
        $this->load->dbutil();
        $file = $this->input->post('tablename');
        $query = $this->db->query("SELECT * FROM ".$file);
        $file_content = $this->dbutil->csv_from_result($query);

        $this->load->helper('download');
        force_download($file.'.csv', $file_content);

        return true;
    }

    /**
     * @return mixed
     */
    function tablesList()
    {
        return $this->db->list_tables();
    }

    /**
     * @return mixed
     */
    function databaseBackups()
    {
        $query = $this->db->get('db_backup');
        $result = $query->result();
        return $result;
    }

    /**
     * @param $tablename
     * @param $data
     *
     * @return mixed
     */
    function add_record_id($tablename, $data)
    {
        $this->db->insert($tablename, $data);
        $id = $this->db->insert_id();
        return $id;
    }

    /**
     * @param $id
     *
     * @return bool
     */
    function delete_backup($id)
    {
        $this->db->where('id', $id);
        $row = $this->db->get('db_backup')->row();

        @unlink('./assets/uploads/backups/'.$row->name);
        $this->db->where('id',$id);
        $this->db->delete('db_backup');
        return true;
    }
}