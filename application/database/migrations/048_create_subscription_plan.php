<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_subscription_plan extends CI_Migration
{
    public function up()
    {

        // Add Fields.
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment'=>TRUE,
                'unsigned'=>TRUE
            ),
            'plan' => array(
                'type' => 'VARCHAR',
                'constraint' => 100
            ),
            'price' => array(
                'type' => 'VARCHAR',
                'constraint' => 100
            )
        ));

        // Add Primary Key.
        $this->dbforge->add_key("id", TRUE);

        // Create Table users
        $this->dbforge->create_table("subscription_plans", TRUE);
    }

    /**
     * down (drop table)
     *
     * @return void
     */
    public function down()
    {
        // Drop table users
        $this->dbforge->drop_table("subscription_plans", TRUE);
    }
}