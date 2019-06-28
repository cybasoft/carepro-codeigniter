<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_daycare_settings_table extends CI_Migration
{

    /**
     * up (create table)
     *
     * @return void
     */

    public function up()
    {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment'=>TRUE,
                'unsigned'=>TRUE
            ),   
            'daycare_id' =>  array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned'=>TRUE
            ),   
            'timezone' => array(
                'type' => 'VARCHAR',
                'constraint' => 191,
                'null' => true
            ),
            'google_analytics' => array(
                'type' => 'VARCHAR',
                'constraint' => 191,
                'null' => true
            ),
            'date_format' => array(
                'type' => 'VARCHAR',
                'constraint' => 191,
                'null' => true
            ),
            'start_time' => array(
                'type' => 'TIME',
                'null' => true
            ),
            'end_time' => array(
                'type' => 'TIME',
                'null' => true
            ),         
            'stripe_pk_test' => array(
                'type' => 'VARCHAR',
                'constraint' => 191,
                'null' => true
            ),
            'stripe_sk_test' => array(
                'type' => 'VARCHAR',
                'constraint' => 191,
                'null' => true
            ),
            'stripe_pk_live' => array(
                'type' => 'VARCHAR',
                'constraint' => 191,
                'null' => true
            ),
            'stripe_sk_live' => array(
                'type' => 'VARCHAR',
                'constraint' => 191,
                'null' => true
            ),
            'stripe_enabled' => array(
                'type' => 'VARCHAR',
                'constraint' => 191,
                'null' => true
            ),
            'invoice_terms' => array(
                'type' => 'VARCHAR',
                'constraint' => 191,
                'null' => true
            ),
            'invoice_logo' => array(
                'type' => 'VARCHAR',
                'constraint' => 191,
                'null' => true
            ),
        ));       

        // Add Primary Key.
        $this->dbforge->add_key("id", TRUE);

        // Create Table users
        $this->dbforge->create_table("daycare_settings", TRUE);

        $this->db->query('ALTER TABLE `daycare_settings` ADD FOREIGN KEY (`daycare_id`) REFERENCES daycare(`id`) ON DELETE CASCADE ON UPDATE CASCADE');
    }

    /**
     * down (drop table)
     *
     * @return void
     */
    public function down()
    {
        $this->dbforge->drop_table("daycare_settings", TRUE);
    }

}
