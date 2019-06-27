<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_company_setting_table extends CI_Migration
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
            'daycare_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned'=>TRUE
            ),
            'daycare_unquie_id'  => array(
                'type' => 'VARCHAR',
                'constraint' => 191,
                'null' => false
            ),
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => 191,
                'null' => false
            ),
            'slogan' => array(
                'type' => 'VARCHAR',
                'constraint' => 191,
                'null' => true
            ),
            'email' => array(
                'type' => 'VARCHAR',
                'constraint' => 191,
            ),
            'facility_id' => array(
                'type' => 'VARCHAR',
                'constraint' => 191,
                'null' => true
            ),
            'tax_id' => array(
                'type' => 'VARCHAR',
                'constraint' => 191,                
            ),
            'phone' => array(
                'type' => 'VARCHAR',
                'constraint' => 191,
            ),
            'fax' => array(
                'type' => 'VARCHAR',
                'constraint' => 191,
                'null' => true
            ),
            'street' => array(
                'type' => 'VARCHAR',
                'constraint' => 191,
            ),
            'street2' => array(
                'type' => 'VARCHAR',
                'constraint' => 191,
            ),
            'city' => array(
                'type' => 'VARCHAR',
                'constraint' => 191,
            ),
            'state' => array(
                'type' => 'VARCHAR',
                'constraint' => 191,
            ),
            'postal_code' => array(
                'type' => 'VARCHAR',
                'constraint' => 191,
            ),
            'country' => array(
                'type' => 'VARCHAR',
                'constraint' => 191,
            ),
            'logo' => array(
                'type' => 'VARCHAR',
                'constraint' => 191,
            )                        
        ));       

        // Add Primary Key.
        $this->dbforge->add_key("id", TRUE);

        // Create Table users
        $this->dbforge->create_table("company_settings", TRUE);

        $this->db->query('ALTER TABLE `company_settings` ADD FOREIGN KEY (`daycare_id`) REFERENCES daycare(`id`) ON DELETE CASCADE ON UPDATE CASCADE');
    }

    /**
     * down (drop table)
     *
     * @return void
     */
    public function down()
    {
        $this->dbforge->drop_table("company_settings", TRUE);
    }

}
