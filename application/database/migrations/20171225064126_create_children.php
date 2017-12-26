<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_children extends CI_Migration
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
            'first_name' => array(
                'type' => 'VARCHAR',
                'constraint' => '20',
            ),
            'last_name' => array(
                'type' => 'VARCHAR',
                'constraint' => '20',
            ),
            'national_id' => array(
                'type' => 'TEXT',
            ),
            'bday' => array(
                'type' => 'VARCHAR',
                'constraint' => '12',
            ),
            'gender' => array(
                'type' => 'INT',
                'constraint' => '2',
            ),
            'blood_type' => array(
                'type' => 'VARCHAR',
                'constraint' => '20',
            ),
            'enroll_date' => array(
                'type' => 'VARCHAR',
                'constraint' => '20',
            ),
            'last_update' => array(
                'type' => 'VARCHAR',
                'constraint' => '20',
            ),
            'status' => array(
                'type' => 'INT',
                'constraint' => '2',
            ),
            'photo' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
            'created_at' => array(
                'type' => 'DATETIME',
            ),
            'user_id' => array(
                'type' => 'INT',
                'constraint' => '10',
                'unsigned' => TRUE,
                'null' => TRUE,
            ),
        ));

        // Add Primary Key.
        $this->dbforge->add_key("id", TRUE);

        // Table attributes.

        $attributes = array(
            'ENGINE' => 'InnoDB',
        );

        // Create Table children
        $this->dbforge->create_table("children", TRUE, $attributes);

    }

    /**
     * down (drop table)
     *
     * @return void
     */
    public function down()
    {
        // Drop table children
        $this->dbforge->drop_table("children", TRUE);
    }

}
