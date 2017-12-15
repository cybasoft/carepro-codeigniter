<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_todo extends CI_Migration
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
            'user_id' => array(
                'type' => 'INT',
                'constraint' => '11',
            ),
            'list_name' => array(
                'type' => 'VARCHAR',
                'constraint' => '50',
            ),
            'last_modified' => array(
                'type' => 'TIMESTAMP',
                'default' => 'CURRENT_TIMESTAMP',
            ),
            'status' => array(
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

        // Create Table todo
        $this->dbforge->create_table("todo", TRUE, $attributes);

    }

    /**
     * down (drop table)
     *
     * @return void
     */
    public function down()
    {
        // Drop table todo
        $this->dbforge->drop_table("todo", TRUE);
    }

}
