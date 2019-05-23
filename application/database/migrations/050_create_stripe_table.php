<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_stripe_table extends CI_Migration
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
            'daycare_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned'=>TRUE
            ),
            'stripe_user_id' => array(
                'type' => 'VARCHAR',
                'constraint' => 100
            ),
            'stripe_publishable_key' => array(
                'type' => 'VARCHAR',
                'constraint' => 100
            ),                        
            'created_at' => [
                'type' => 'TIMESTAMP',
                'default' => 'CURRENT_TIMESTAMP',
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
            ]
        ));

        // Add Primary Key.
        $this->dbforge->add_key("id", TRUE);

        // Create Table users
        $this->dbforge->create_table("stripe_connect_detail", TRUE);

        $this->db->query('ALTER TABLE `stripe_connect_detail` ADD FOREIGN KEY (`daycare_id`) REFERENCES daycare(`id`) ON DELETE CASCADE ON UPDATE CASCADE');
    }

    /**
     * down (drop table)
     *
     * @return void
     */
    public function down()
    {
        // Drop table users
        $this->dbforge->drop_table("stripe_connect_detail", TRUE);
    }

}
