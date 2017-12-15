<?php defined('BASEPATH') or exit('No direct script access allowed');

class Migration_create_calendar extends CI_Migration
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
            'title' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
            ),
            'start' => array(
                'type' => 'DATE',
            ),
            'start_t' => array(
                'type' => 'TIME',
            ),
            'end' => array(
                'type' => 'DATE',
                'null' => TRUE,
            ),
            'end_t' => array(
                'type' => 'TIME',
            ),
            'description' => array(
                'type' => 'TEXT',
            ),
            'allDay' => array(
                'type' => 'VARCHAR',
                'constraint' => '10',
                'default' => 'false',
            ),
        ));

        // Add Primary Key.
        $this->dbforge->add_key("id", TRUE);

        // Table attributes.

        $attributes = array(
            'ENGINE' => 'InnoDB',
        );

        // Create Table calendar
        $this->dbforge->create_table("calendar", TRUE, $attributes);

    }

    /**
     * down (drop table)
     *
     * @return void
     */
    public function down()
    {
        // Drop table calendar
        $this->dbforge->drop_table("calendar", TRUE);
    }

}
