<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_settings extends CI_Migration
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
                'constraint' => '10',
            ),
            'code' => array(
                'type' => 'INT',
                'constraint' => '20',
            ),
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => '20',
            ),
            'slogan' => array(
                'type' => 'VARCHAR',
                'constraint' => '50',
            ),
            'logo' => array(
                'type' => 'VARCHAR',
                'constraint' => '50',
            ),
            'allow_reg' => array(
                'type' => 'INT',
                'constraint' => '2',
            ),
            'captcha' => array(
                'type' => 'INT',
                'constraint' => '2',
            ),
            'maintenance' => array(
                'type' => 'INT',
                'constraint' => '2',
            ),
            'demo_mode' => array(
                'type' => 'INT',
                'constraint' => '11',
            ),
            'encrypt_key' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
            'paypal_email' => array(
                'type' => 'VARCHAR',
                'constraint' => '50',
            ),
            'email' => array(
                'type' => 'VARCHAR',
                'constraint' => '50',
            ),
            'phone' => array(
                'type' => 'VARCHAR',
                'constraint' => '20',
            ),
            'fax' => array(
                'type' => 'VARCHAR',
                'constraint' => '20',
            ),
            'website' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
            'street' => array(
                'type' => 'VARCHAR',
                'constraint' => '50',
            ),
            'city' => array(
                'type' => 'VARCHAR',
                'constraint' => '20',
            ),
            'state' => array(
                'type' => 'VARCHAR',
                'constraint' => '20',
            ),
            'zip' => array(
                'type' => 'INT',
                'constraint' => '5',
            ),
            'country' => array(
                'type' => 'VARCHAR',
                'constraint' => '20',
            ),
            'time_zone' => array(
                'type' => 'VARCHAR',
                'constraint' => '20',
            ),
            'currency' => array(
                'type' => 'VARCHAR',
                'constraint' => '10',
            ),
            'curr_symbol' => array(
                'type' => 'VARCHAR',
                'constraint' => '5',
            ),
            'date_format' => array(
                'type' => 'VARCHAR',
                'constraint' => '20',
            ),
            'google_analytics' => array(
                'type' => 'VARCHAR',
                'constraint' => '50',
            ),
        ));

        // Add Primary Key.
        $this->dbforge->add_key("id", TRUE);

        // Table attributes.

        $attributes = array(
            'ENGINE' => 'MyISAM',
        );

        // Create Table settings
        $this->dbforge->create_table("settings", TRUE, $attributes);

    }

    /**
     * down (drop table)
     *
     * @return void
     */
    public function down()
    {
        // Drop table settings
        $this->dbforge->drop_table("settings", TRUE);
    }

}
