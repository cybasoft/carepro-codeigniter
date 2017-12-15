<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_child_users extends CI_Migration
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
                'constraint' => '5',
            ),
            'user_id' => array(
                'type' => 'INT',
                'constraint' => '5',
            ),
        ));

        // Add Primary Key.
        $this->dbforge->add_key("id", TRUE);

        // Table attributes.

        $attributes = array(
            'ENGINE' => 'MyISAM',
        );

        // Create Table child_users
        $this->dbforge->create_table("child_users", TRUE, $attributes);

    }

    /**
     * down (drop table)
     *
     * @return void
     */
    public function down()
    {
        // Drop table child_users
        $this->dbforge->drop_table("child_users", TRUE);
    }

}
