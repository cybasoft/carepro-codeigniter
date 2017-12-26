<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_child_foodpref extends CI_Migration
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
                'constraint' => 11,
                'unsigned'=>TRUE,
                'auto_increment'=>TRUE
            ),
            'child_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned'=>TRUE
            ),
            'food' => array(
                'type' => 'VARCHAR',
                'constraint' => '50',
            ),
            'food_time' => array(
                'type' => 'VARCHAR',
                'constraint' => '20',
            ),
            'comment' => array(
                'type' => 'TEXT',
            ),
            'user_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
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

        // Create Table child_foodpref
        $this->dbforge->create_table("child_foodpref", TRUE, $attributes);
        $this->db->query('ALTER TABLE `child_foodpref` ADD FOREIGN KEY (`user_id`) REFERENCES users(`id`) ON DELETE RESTRICT ON UPDATE CASCADE');
        $this->db->query('ALTER TABLE `child_foodpref` ADD FOREIGN KEY (`child_Id`) REFERENCES children(`id`) ON DELETE CASCADE ON UPDATE CASCADE');

    }

    /**
     * down (drop table)
     *
     * @return void
     */
    public function down()
    {
        // Drop table child_foodpref
        $this->dbforge->drop_table("child_foodpref", TRUE);
    }

}
