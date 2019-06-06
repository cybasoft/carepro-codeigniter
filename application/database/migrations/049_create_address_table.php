<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_address_table extends CI_Migration
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
            'address_line_1' => array(
                'type' => 'VARCHAR',
                'constraint' => 191
            ),
            'address_line_2' => array(
                'type' => 'VARCHAR',
                'constraint' => 191,
                'null'=>TRUE
            ),
            'phone' => array(
                'type' => 'VARCHAR',
                'constraint' => 50,
            ),
            'city' => array(
                'type' => 'VARCHAR',
                'constraint' => 191,                
            ),
            'state' => array(
                'type' => 'VARCHAR',
                'constraint' => 191,                
            ),
            'zip_code' => array(
                'type' => 'VARCHAR',
                'constraint' => 191,                
            ),
            'country' => array(
                'type' => 'VARCHAR',
                'constraint' => 191,                
            ),
            'created_at' => array(
                'type' => 'TIMESTAMP',
                'default' => 'CURRENT_TIMESTAMP',
            ),
            'updated_at' => array(
                'type' => 'TIMESTAMP',
            )
        ));

        // Add Primary Key.
        $this->dbforge->add_key("id", TRUE);

        // Create Table users
        $this->dbforge->create_table("address", TRUE);

        $this->db->query('ALTER TABLE `users` ADD FOREIGN KEY (`address_id`) REFERENCES address(`id`) ON DELETE CASCADE ON UPDATE CASCADE');
        $this->db->query('ALTER TABLE `daycare` ADD FOREIGN KEY (`address_id`) REFERENCES address(`id`) ON DELETE CASCADE ON UPDATE CASCADE');
    }

    /**
     * down (drop table)
     *
     * @return void
     */
    public function down()
    {
        // Drop table users
        $this->dbforge->drop_table("address", TRUE);
    }
}