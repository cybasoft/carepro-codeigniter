<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_ci_sessions extends CI_Migration
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
            'session_id' => array(
                'type' => 'VARCHAR',
                'constraint' => '40',
                'default' => '0',
            ),
            'ip_address' => array(
                'type' => 'VARCHAR',
                'constraint' => '16',
                'default' => '0',
            ),
            'user_agent' => array(
                'type' => 'VARCHAR',
                'constraint' => '150',
            ),
            'last_activity' => array(
                'type' => 'INT',
                'constraint' => '10',
                'unsigned' => TRUE,
                'default' => '0',
            ),
            'user_data' => array(
                'type' => 'TEXT',
            ),
        ));

        // Add Primary Key.
        $this->dbforge->add_key("session_id", TRUE);

        // Table attributes.

        $attributes = array(
            'ENGINE' => 'InnoDB',
        );

        // Create Table ci_sessions
        $this->dbforge->create_table("ci_sessions", TRUE, $attributes);

    }

    /**
     * down (drop table)
     *
     * @return void
     */
    public function down()
    {
        // Drop table ci_sessions
        $this->dbforge->drop_table("ci_sessions", TRUE);
    }

}
