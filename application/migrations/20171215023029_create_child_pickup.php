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
                'constraint' => '10',
            ),
            'child_id' => array(
                'type' => 'INT',
                'constraint' => '10',
            ),
            'fname' => array(
                'type' => 'VARCHAR',
                'constraint' => '20',
            ),
            'lname' => array(
                'type' => 'VARCHAR',
                'constraint' => '20',
            ),
            'cell' => array(
                'type' => 'VARCHAR',
                'constraint' => '12',
            ),
            'other_phone' => array(
                'type' => 'VARCHAR',
                'constraint' => '12',
            ),
            'address' => array(
                'type' => 'TEXT',
            ),
            'pin' => array(
                'type' => 'INT',
                'constraint' => '6',
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
        ));

        // Add Primary Key.
        $this->dbforge->add_key("id", TRUE);

        // Table attributes.

        $attributes = array(
            'ENGINE' => 'MyISAM',
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
