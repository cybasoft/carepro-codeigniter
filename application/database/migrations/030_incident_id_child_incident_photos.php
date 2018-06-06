<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_incident_id_child_incident_photos extends CI_Migration
{

    /**
     * up (create table)
     *
     * @return void
     */
    protected $table = 'child_incident_photos';

    public function up()
    {
        $field1 = array(
            'incident_id' => array(
                'type' => 'INT',
                'constraint' => '11',
                'unsigned' => TRUE,
            ),
        );
        $this->dbforge->add_column($this->table, $field1);
        $this->db->query('ALTER TABLE `child_incident_photos` ADD FOREIGN KEY (`incident_id`) REFERENCES child_incident(`id`) ON DELETE CASCADE ON UPDATE CASCADE');
    }

    /**
     * down (drop table)
     *
     * @return void
     */
    public function down()
    {
        // Drop table child_allergy
        $this->dbforge->drop_column($this->table, 'incident_id');
    }

}
