<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_child_foodpref extends CI_Migration
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
            'food' => array(
                'type' => 'VARCHAR',
                'constraint' => '50',
            ),
            'food_time' => array(
                'type' => 'VARCHAR',
                'constraint' => '20',
            ),
            'comment' => array(
                'type' => 'TEXT',
            ),
            'user_id' => array(
                'type' => 'INT',
                'constraint' => '10',
                'unsigned' => TRUE,
            ),
            'created_at' => array(
                'type' => 'DATETIME',
            ),
        ));

        // Add Primary Key.
        $this->dbforge->add_key("id", TRUE);

        // Table attributes.

        $attributes = array(
            'ENGINE' => 'InnoDB',
        );

        // Create Table child_foodpref
        $this->dbforge->create_table("child_foodpref", TRUE, $attributes);

    }

    /**
     * down (drop table)
     *
     * @return void
     */
    public function down()
    {
        // Drop table child_foodpref
        $this->dbforge->drop_table("child_foodpref", TRUE);
    }

}
