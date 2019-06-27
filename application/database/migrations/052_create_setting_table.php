<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_setting_table extends CI_Migration
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
            'option_name' => array(
                'type' => 'VARCHAR',
                'constraint' => 191,
                'null' => false
            ),
            'option_value' => array(
                'type' => 'LONGTEXT',
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
