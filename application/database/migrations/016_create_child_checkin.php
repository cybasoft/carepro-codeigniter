<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_child_checkin extends CI_Migration
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
            'time_in' => array(
                'type' => 'DATETIME',
            ),
            'time_out' => array(
                'type' => 'DATETIME',
                'null' => TRUE,
            ),
            'in_guardian' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
            ),
            'out_guardian' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => TRUE,
            ),
            'in_staff_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned'=>TRUE
            ),
            'out_staff_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE,
                'unsigned'=>TRUE
            ),
            'remarks' => array(
                'type' => 'TEXT',
                'null' => TRUE,
            ),
        ));

        // Add Primary Key.
        $this->dbforge->add_key("id", TRUE);

        // Table attributes.

        $attributes = array(
            'ENGINE' => 'InnoDB',
        );

        // Create Table child_checkin
        $this->dbforge->create_table("child_checkin", TRUE, $attributes);

        $this->db->query('ALTER TABLE `child_checkin` ADD FOREIGN KEY (`child_id`) REFERENCES children(`id`) ON DELETE CASCADE ON UPDATE CASCADE');
        $this->db->query('ALTER TABLE `child_checkin` ADD FOREIGN KEY (`in_staff_id`) REFERENCES users(`id`) ON DELETE RESTRICT ON UPDATE CASCADE');
        $this->db->query('ALTER TABLE `child_checkin` ADD FOREIGN KEY (`out_staff_id`) REFERENCES users(`id`) ON DELETE RESTRICT ON UPDATE CASCADE');
    }

    /**
     * down (drop table)
     *
     * @return void
     */
    public function down()
    {
        // Drop table child_checkin
        $this->dbforge->drop_table("child_checkin", TRUE);
    }

}
