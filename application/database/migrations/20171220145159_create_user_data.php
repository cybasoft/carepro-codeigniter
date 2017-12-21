<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_user_data extends CI_Migration
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
                'constraint' => '5',
            ),
            'user_id' => array(
                'type' => 'INT',
                'constraint' => '5',
            ),
            'phone' => array(
                'type' => 'VARCHAR',
                'constraint' => '20',
            ),
            'phone2' => array(
                'type' => 'VARCHAR',
                'constraint' => '20',
            ),
            'street' => array(
                'type' => 'VARCHAR',
                'constraint' => '50',
            ),
            'street2' => array(
                'type' => 'VARCHAR',
                'constraint' => '20',
            ),
            'city' => array(
                'type' => 'VARCHAR',
                'constraint' => '20',
            ),
            'state' => array(
                'type' => 'VARCHAR',
                'constraint' => '20',
            ),
            'zip' => array(
                'type' => 'INT',
                'constraint' => '5',
            ),
            'country' => array(
                'type' => 'VARCHAR',
                'constraint' => '20',
            ),
            'gender' => array(
                'type' => 'VARCHAR',
                'constraint' => '10',
            ),
            'pin' => array(
                'type' => 'INT',
                'constraint' => '10',
            ),
            'photo' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
        ));

        // Add Primary Key.
        $this->dbforge->add_key("id", TRUE);

        // Table attributes.

        $attributes = array(
            'ENGINE' => 'InnoDB',
        );

        // Create Table user_data
        $this->dbforge->create_table("user_data", TRUE, $attributes);

    }

    /**
     * down (drop table)
     *
     * @return void
     */
    public function down()
    {
        // Drop table user_data
        $this->dbforge->drop_table("user_data", TRUE);
    }

}
