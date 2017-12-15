<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_child_insurance extends CI_Migration
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
            'p_name' => array(
                'type' => 'VARCHAR',
                'constraint' => '20',
            ),
            'p_num' => array(
                'type' => 'INT',
                'constraint' => '20',
            ),
            'g_num' => array(
                'type' => 'INT',
                'constraint' => '20',
            ),
            'expiry' => array(
                'type' => 'VARCHAR',
                'constraint' => '20',
            ),
        ));

        // Add Primary Key.
        $this->dbforge->add_key("id", TRUE);

        // Table attributes.

        $attributes = array(
            'ENGINE' => 'InnoDB',
        );

        // Create Table child_insurance
        $this->dbforge->create_table("child_insurance", TRUE, $attributes);

    }

    /**
     * down (drop table)
     *
     * @return void
     */
    public function down()
    {
        // Drop table child_insurance
        $this->dbforge->drop_table("child_insurance", TRUE);
    }

}
