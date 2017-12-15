<?php defined('BASEPATH') or exit('No direct script access allowed');

class Migration_create_memberships extends CI_Migration
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
            'member_type' => array(
                'type' => 'VARCHAR',
                'constraint' => '20',
            ),
            'pay_method' => array(
                'type' => 'VARCHAR',
                'constraint' => '20',
            ),
            'start_date' => array(
                'type' => 'INT',
                'constraint' => '20',
            ),
            'end_date' => array(
                'type' => 'INT',
                'constraint' => '20',
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
            'ENGINE' => 'InnoDB',
        );

        // Create Table memberships
        $this->dbforge->create_table("memberships", TRUE, $attributes);

    }

    /**
     * down (drop table)
     *
     * @return void
     */
    public function down()
    {
        // Drop table memberships
        $this->dbforge->drop_table("memberships", TRUE);
    }

}
