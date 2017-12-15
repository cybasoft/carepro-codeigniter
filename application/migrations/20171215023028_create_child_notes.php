<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_child_notes extends CI_Migration
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
                'constraint' => '10',
            ),
            'child_id' => array(
                'type' => 'INT',
                'constraint' => '10',
            ),
            'content' => array(
                'type' => 'TEXT',
            ),
            'user_id' => array(
                'type' => 'INT',
                'constraint' => '10',
            ),
            'date' => array(
                'type' => 'VARCHAR',
                'constraint' => '20',
            ),
        ));

        // Add Primary Key.
        $this->dbforge->add_key("id", TRUE);

        // Table attributes.

        $attributes = array(
            'ENGINE' => 'MyISAM',
        );

        // Create Table child_notes
        $this->dbforge->create_table("child_notes", TRUE, $attributes);

    }

    /**
     * down (drop table)
     *
     * @return void
     */
    public function down()
    {
        // Drop table child_notes
        $this->dbforge->drop_table("child_notes", TRUE);
    }

}
