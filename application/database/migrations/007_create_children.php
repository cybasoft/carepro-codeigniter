<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_children extends CI_Migration
{

    /**
     * up (create table)
     *
     * @return void
     */
    public function up()
    {

        // Add Fields.
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment'=>TRUE,
                'unsigned'=>TRUE
            ),
            'first_name' => array(
                'type' => 'VARCHAR',
                'constraint' => 20,
            ),
            'last_name' => array(
                'type' => 'VARCHAR',
                'constraint' => 20,
            ),
            'national_id' => array(
                'type' => 'VARCHAR',
                'constraint'=>255,
                'null'=>FALSE
            ),
            'bday' => array(
                'type' => 'DATETIME',
                'null'=>FALSE
            ),
            'gender' => array(
                'type' => 'VARCHAR',
                'constraint' => '20',
            ),
            'blood_type' => array(
                'type' => 'VARCHAR',
                'constraint' => 20,
            ),
            'last_update' => array(
                'type' => 'DATETIME'
            ),
            'status' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
            ),
            'photo' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
            ),
            'user_id' => array(
                'type' => 'INT',
                'constraint' => '11',
                'unsigned' => TRUE
            ),
            'created_at' => array(
                'type' => 'DATETIME',
            ),
        ));

        // Add Primary Key.
        $this->dbforge->add_key("id", TRUE);



        // Create Table children
        $this->dbforge->create_table("children", TRUE);
        $this->db->query('ALTER TABLE `children` ADD FOREIGN KEY (`user_id`) REFERENCES users(`id`) ON DELETE CASCADE ON UPDATE CASCADE');
    }

    /**
     * down (drop table)
     *
     * @return void
     */
    public function down()
    {
        // Drop table children
        $this->dbforge->drop_table("children", TRUE);
    }

}
