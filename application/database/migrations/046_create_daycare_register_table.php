<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_daycare_register_table extends CI_Migration
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
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => 100
            ),
            'employee_tax_identifier' => array(
                'type' => 'VARCHAR',
                'constraint' => 100
            ),
            'address_id' => array(
                'type' => 'INT',
                'constraint' => 100,
            ),            
            'daycare_id' => array(
                'type' => 'VARCHAR',
                'constraint' => 20,
            ),
            'logo' => array(
                'type' => 'VARCHAR',
                'constraint' => 200,
            ),
            'created_at' => [
                'type' => 'TIMESTAMP',
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
            ],
            'deleted_at' => [
                'type' => 'TIMESTAMP',
            ]
        ));

        // Add Primary Key.
        $this->dbforge->add_key("id", TRUE);

        // Create Table users
        $this->dbforge->create_table("daycare", TRUE);
    }

    /**
     * down (drop table)
     *
     * @return void
     */
    public function down()
    {
        // Drop table users
        $this->dbforge->drop_table("daycare", TRUE);
    }

}
