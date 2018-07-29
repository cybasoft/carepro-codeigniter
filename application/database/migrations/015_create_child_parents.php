<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_child_parents extends CI_Migration
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
            'child_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
            ),
            'user_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
            ),
        ));

        // Add Primary Key.
        $this->dbforge->add_key(array('child_id', 'user_id'), TRUE);

        // Create Table child_parents
        $this->dbforge->create_table("child_parents", TRUE);
        $this->db->query('ALTER TABLE `child_parents` ADD FOREIGN KEY (`child_id`) REFERENCES children(`id`) ON DELETE CASCADE ON UPDATE CASCADE');
        $this->db->query('ALTER TABLE `child_parents` ADD FOREIGN KEY (`user_id`) REFERENCES users(`id`) ON DELETE RESTRICT ON UPDATE CASCADE');
    }

    /**
     * down (drop table)
     *
     * @return void
     */
    public function down()
    {
        // Drop table child_parents
        $this->dbforge->drop_table("child_parents", TRUE);
    }

}
