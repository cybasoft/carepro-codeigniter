<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_event_log extends CI_Migration
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
            'company' => array(
                'type' => 'INT',
                'constraint' => '11',
            ),
            'user_id' => array(
                'type' => 'INT',
                'constraint' => '11',
            ),
            'date' => array(
                'type' => 'VARCHAR',
                'constraint' => '20',
            ),
            'event' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
            ),
        ));

        // Add Primary Key.
        $this->dbforge->add_key("id", TRUE);

        // Table attributes.

        $attributes = array(
            'ENGINE' => 'InnoDB',
        );

        // Create Table event_log
        $this->dbforge->create_table("event_log", TRUE, $attributes);

    }

    /**
     * down (drop table)
     *
     * @return void
     */
    public function down()
    {
        // Drop table event_log
        $this->dbforge->drop_table("event_log", TRUE);
    }

}
