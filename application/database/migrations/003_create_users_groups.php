<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_users_groups extends CI_Migration
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
            'id'=>array(
                'type'=>'INT',
                'constraint'=>11,
                'unsigned'=>TRUE,
                'auto_increment'=>TRUE
            ),
            'user_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
            ),
            'group_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
            ),
        ));

        // Add Primary Key.
        $this->dbforge->add_key('id',TRUE);
        $this->dbforge->add_key(array('user_id','group_id'));

        // Table attributes.

        $attributes = array(
            'ENGINE' => 'InnoDB',
        );

        // Create Table users_groups
        $this->dbforge->create_table("users_groups", TRUE, $attributes);
        $this->db->query('ALTER TABLE `users_groups` ADD FOREIGN KEY (`user_id`) REFERENCES users(`id`) ON DELETE CASCADE ON UPDATE CASCADE');
        $this->db->query('ALTER TABLE `users_groups` ADD FOREIGN KEY (`group_id`) REFERENCES groups(`id`) ON DELETE CASCADE ON UPDATE CASCADE');
    }

    /**
     * down (drop table)
     *
     * @return void
     */
    public function down()
    {
        // Drop table users_groups
        $this->dbforge->drop_table("users_groups", TRUE);
    }

}
