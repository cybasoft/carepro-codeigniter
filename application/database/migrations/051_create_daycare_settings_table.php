<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_daycare_settings_table extends CI_Migration
{

    /**
     * up (create table)
     *
     * @return void
     */

    public
    function up()
    {
        $this->dbforge->add_field([
            'id'               => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => TRUE,
                'unsigned'       => TRUE,
            ],
            'daycare_id'       => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => TRUE,
            ],
            'timezone'         => [
                'type'       => 'VARCHAR',
                'constraint' => 191,
                'null'       => TRUE,
            ],
            'date_format'      => [
                'type'       => 'VARCHAR',
                'constraint' => 191,
                'null'       => TRUE,
            ],
            'start_time'       => [
                'type' => 'TIME',
                'null' => TRUE,
            ],
            'end_time'         => [
                'type' => 'TIME',
                'null' => TRUE,
            ],
            'stripe_pk_test'   => [
                'type'       => 'VARCHAR',
                'constraint' => 191,
                'null'       => TRUE,
            ],
            'stripe_sk_test'   => [
                'type'       => 'VARCHAR',
                'constraint' => 191,
                'null'       => TRUE,
            ],
            'stripe_pk_live'   => [
                'type'       => 'VARCHAR',
                'constraint' => 191,
                'null'       => TRUE,
            ],
            'stripe_sk_live'   => [
                'type'       => 'VARCHAR',
                'constraint' => 191,
                'null'       => TRUE,
            ],
            'stripe_toggle'    => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => TRUE,
            ],
            'stripe_enabled'   => [
                'type'       => 'VARCHAR',
                'constraint' => 191,
                'null'       => TRUE,
            ],
            'invoice_terms'    => [
                'type'       => 'VARCHAR',
                'constraint' => 191,
                'null'       => TRUE,
            ],
            'invoice_logo'     => [
                'type'       => 'VARCHAR',
                'constraint' => 191,
                'null'       => TRUE,
            ],

            'tawkto_embed_url' => [
                'type'     => 'VARCHAR',
                'constant' => 191,
                'null'     => TRUE,
            ],
        ]);

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
    public
    function down()
    {
        $this->dbforge->drop_table("daycare_settings", TRUE);
    }

}
