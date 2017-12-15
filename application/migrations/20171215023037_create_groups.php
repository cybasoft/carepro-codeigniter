<?php defined('BASEPATH') or exit('No direct script access allowed');

class Migration_create_groups extends CI_Migration
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
                'type' => 'MEDIUMINT',
                'constraint' => '8',
                'unsigned' => TRUE,
            ),
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => '20',
            ),
            'description' => array(
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

        // Create Table groups
        $this->dbforge->create_table("groups", TRUE, $attributes);

    }

    /**
     * down (drop table)
     *
     * @return void
     */
    public function down()
    {
        // Drop table groups
        $this->dbforge->drop_table("groups", TRUE);
    }

}
