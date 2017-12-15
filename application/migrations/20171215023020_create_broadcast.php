<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_broadcast extends CI_Migration
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
                'constraint' => '11',
            ),
            'user' => array(
                'type' => 'VARCHAR',
                'constraint' => '60',
            ),
            'message' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
            'date_time' => array(
                'type' => 'TIMESTAMP',
                'default' => 'CURRENT_TIMESTAMP',
            ),
            'ip_address' => array(
                'type' => 'VARCHAR',
                'constraint' => '40',
            ),
        ));

        // Add Primary Key.
        $this->dbforge->add_key("id", TRUE);

        // Table attributes.

        $attributes = array(
            'ENGINE' => 'InnoDB',
        );

        // Create Table broadcast
        $this->dbforge->create_table("broadcast", TRUE, $attributes);

    }

    /**
     * down (drop table)
     *
     * @return void
     */
    public function down()
    {
        // Drop table broadcast
        $this->dbforge->drop_table("broadcast", TRUE);
    }

}
