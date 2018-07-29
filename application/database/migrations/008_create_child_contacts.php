<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_child_contacts extends CI_Migration
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
                'auto_increment'=>TRUE,
                'unsigned'=>TRUE
            ),
            'child_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
            ),
            'contact_name' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
            'relation' => array(
                'type' => 'VARCHAR',
                'constraint' => '20',
            ),
            'phone' => array(
                'type' => 'VARCHAR',
                'constraint' => '20',
                'null' => TRUE,
            ),
            'address' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE,
            ),
            'user_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned'=>TRUE
            ),
            'created_at' => array(
                'type' => 'DATETIME',
            ),
        ));

        // Add Primary Key.
        $this->dbforge->add_key("id", TRUE);



        // Create Table child_contacts
        $this->dbforge->create_table("child_contacts", TRUE);

        $this->db->query('ALTER TABLE `child_contacts` ADD FOREIGN KEY (`user_id`) REFERENCES users(`id`) ON DELETE RESTRICT ON UPDATE CASCADE');

        $this->db->query('ALTER TABLE `child_contacts` ADD FOREIGN KEY (`child_id`) REFERENCES children(`id`) ON DELETE CASCADE ON UPDATE CASCADE');

    }

    /**
     * down (drop table)
     *
     * @return void
     */
    public function down()
    {
        // Drop table child_contacts
        $this->dbforge->drop_table("child_contacts", TRUE);
    }

}
