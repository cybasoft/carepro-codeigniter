<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_child_pickup extends CI_Migration
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
            'first_name' => array(
                'type' => 'VARCHAR',
                'constraint' => '20',
            ),
            'last_name' => array(
                'type' => 'VARCHAR',
                'constraint' => '20',
            ),
            'cell' => array(
                'type' => 'VARCHAR',
                'constraint' => '20',
            ),
            'other_phone' => array(
                'type' => 'VARCHAR',
                'constraint' => '20',
            ),
            'address' => array(
                'type' => 'TEXT',
            ),
            'pin' => array(
                'type' => 'INT',
                'constraint' => '11',
            ),
            'relation' => array(
                'type' => 'VARCHAR',
                'constraint' => '20',
            ),
            'photo' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
            'status' => array(
                'type' => 'INT',
                'constraint' => '11',
            ),
            'user_id' => array(
                'type' => 'INT',
                'constraint' => '11',
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

        // Create Table child_pickup
        $this->dbforge->create_table("child_pickup", TRUE, $attributes);

    }

    /**
     * down (drop table)
     *
     * @return void
     */
    public function down()
    {
        // Drop table child_pickup
        $this->dbforge->drop_table("child_pickup", TRUE);
    }

}
