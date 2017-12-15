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
                'constraint' => '10',
            ),
            'company' => array(
                'type' => 'INT',
                'constraint' => '11',
            ),
            'fname' => array(
                'type' => 'VARCHAR',
                'constraint' => '20',
            ),
            'lname' => array(
                'type' => 'VARCHAR',
                'constraint' => '20',
            ),
            'ssn' => array(
                'type' => 'BLOB',
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
            'photo' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
            'status' => array(
                'type' => 'INT',
                'constraint' => '2',
            ),
        ));

        // Add Primary Key.
        $this->dbforge->add_key("id", TRUE);

        // Table attributes.

        $attributes = array(
            'ENGINE' => 'MyISAM',
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
