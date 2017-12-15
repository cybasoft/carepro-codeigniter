<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_classrooms extends CI_Migration
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
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => '20',
            ),
            'desc' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
            ),
            'status' => array(
                'type' => 'VARCHAR',
                'constraint' => '10',
            ),
        ));

        // Add Primary Key.
        $this->dbforge->add_key("id", TRUE);

        // Table attributes.

        $attributes = array(
            'ENGINE' => 'InnoDB',
        );

        // Create Table classrooms
        $this->dbforge->create_table("classrooms", TRUE, $attributes);

    }

    /**
     * down (drop table)
     *
     * @return void
     */
    public function down()
    {
        // Drop table classrooms
        $this->dbforge->drop_table("classrooms", TRUE);
    }

}
