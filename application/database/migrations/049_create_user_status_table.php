<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_user_status_table extends CI_Migration
{
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
            'status' => array(
                'type' => 'VARCHAR',
                'constraint' => 100
            )
        ));

        // Add Primary Key.
        $this->dbforge->add_key("id", TRUE);

        // Create Table users
        $this->dbforge->create_table("user_status", TRUE);
    }

    /**
     * down (drop table)
     *
     * @return void
     */
    public function down()
    {
        // Drop table users
        $this->dbforge->drop_table("user_status", TRUE);
    }
}