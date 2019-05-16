<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_users extends CI_Migration
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
            'first_name' => array(
                'type' => 'VARCHAR',
                'constraint' => 100
            ),
            'last_name' => array(
                'type' => 'VARCHAR',
                'constraint' => 100
            ),
            'email' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
                'unique'=>TRUE
            ),
            'password' => array(
                'type' => 'VARCHAR',
                'constraint' => 255,
            ),
            'active' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'unsigned' => TRUE,
                'null' => TRUE,
            ),
            'forgotten_password_code' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => TRUE,
            ),
            'forgotten_password_time' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'null' => TRUE,
            ),
            'activation_code' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => TRUE,
            ),
            'last_login' => array(
                'type' => 'DATETIME',
                'null' => TRUE,
            ),
            'ip_address' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null'=>TRUE
            ),
            'phone' => array(
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => TRUE,
            ),
            'phone2' => array(
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => TRUE,
            ),
            'address' => array(
                'type' => 'TEXT',
                'null' => TRUE,
            ),
            'pin' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE,
            ),
            'photo' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => TRUE,
            ),
            'created_at' => array(
                'type' => 'TIMESTAMP',
                'default' => 'CURRENT_TIMESTAMP',
            )
        ));

        // Add Primary Key.
        $this->dbforge->add_key("id", TRUE);

        // Create Table users
        $this->dbforge->create_table("users", TRUE);

    }

    /**
     * down (drop table)
     *
     * @return void
     */
    public function down()
    {
        // Drop table users
        $this->dbforge->drop_table("users", TRUE);
    }

}
