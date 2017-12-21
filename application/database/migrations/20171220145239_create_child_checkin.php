<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_child_checkin extends CI_Migration
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
            'child_id' => array(
                'type' => 'INT',
                'constraint' => '11',
            ),
            'in_parent_id' => array(
                'type' => 'INT',
                'constraint' => '11',
            ),
            'time_in' => array(
                'type' => 'INT',
                'constraint' => '11',
                'null' => TRUE,
            ),
            'in_staff_id' => array(
                'type' => 'INT',
                'constraint' => '11',
            ),
            'out_parent_id' => array(
                'type' => 'INT',
                'constraint' => '11',
            ),
            'time_out' => array(
                'type' => 'INT',
                'constraint' => '11',
                'null' => TRUE,
            ),
            'out_staff_id' => array(
                'type' => 'INT',
                'constraint' => '11',
            ),
            'checkin_status' => array(
                'type' => 'INT',
                'constraint' => '11',
            ),
        ));

        // Add Primary Key.
        $this->dbforge->add_key("id", TRUE);

        // Table attributes.

        $attributes = array(
            'ENGINE' => 'InnoDB',
        );

        // Create Table child_checkin
        $this->dbforge->create_table("child_checkin", TRUE, $attributes);

    }

    /**
     * down (drop table)
     *
     * @return void
     */
    public function down()
    {
        // Drop table child_checkin
        $this->dbforge->drop_table("child_checkin", TRUE);
    }

}
