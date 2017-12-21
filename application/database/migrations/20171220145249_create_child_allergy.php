<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_child_allergy extends CI_Migration
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
                'constraint' => '11',
            ),
            'allergy' => array(
                'type' => 'VARCHAR',
                'constraint' => '20',
            ),
            'reaction' => array(
                'type' => 'VARCHAR',
                'constraint' => '50',
            ),
            'notes' => array(
                'type' => 'VARCHAR',
                'constraint' => '250',
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

        // Create Table child_allergy
        $this->dbforge->create_table("child_allergy", TRUE, $attributes);

    }

    /**
     * down (drop table)
     *
     * @return void
     */
    public function down()
    {
        // Drop table child_allergy
        $this->dbforge->drop_table("child_allergy", TRUE);
    }

}
