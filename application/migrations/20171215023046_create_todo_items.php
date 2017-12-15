<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_todo_items extends CI_Migration
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
            'todo_id' => array(
                'type' => 'INT',
                'constraint' => '11',
            ),
            'item_name' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
            'last_modified' => array(
                'type' => 'TIMESTAMP',
                'default' => 'CURRENT_TIMESTAMP',
            ),
            'item_status' => array(
                'type' => 'VARCHAR',
                'constraint' => '20',
            ),
        ));

        // Add Primary Key.
        $this->dbforge->add_key("id", TRUE);

        // Table attributes.

        $attributes = array(
            'ENGINE' => 'InnoDB',
        );

        // Create Table todo_items
        $this->dbforge->create_table("todo_items", TRUE, $attributes);

    }

    /**
     * down (drop table)
     *
     * @return void
     */
    public function down()
    {
        // Drop table todo_items
        $this->dbforge->drop_table("todo_items", TRUE);
    }

}
