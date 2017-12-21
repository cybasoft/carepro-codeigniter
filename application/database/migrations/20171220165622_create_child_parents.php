<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_child_parents extends CI_Migration
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
            'child_id' => array(
                'type' => 'INT',
                'constraint' => '11',
                'unsigned' => TRUE,
            ),
            'user_id' => array(
                'type' => 'INT',
                'constraint' => '11',
                'unsigned' => TRUE,
            ),
        ));

        // Add Primary Key.
        $this->dbforge->add_key("child_id", TRUE);
        $this->dbforge->add_key("user_id", TRUE);

        // Table attributes.

        $attributes = array(
            'ENGINE' => 'InnoDB',
        );

        // Create Table child_parents
        $this->dbforge->create_table("child_parents", TRUE, $attributes);

    }

    /**
     * down (drop table)
     *
     * @return void
     */
    public function down()
    {
        // Drop table child_parents
        $this->dbforge->drop_table("child_parents", TRUE);
    }

}
