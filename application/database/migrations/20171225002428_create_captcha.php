<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_captcha extends CI_Migration
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
            'captcha_id' => array(
                'type' => 'BIGINT',
                'constraint' => '13',
                'unsigned' => TRUE,
            ),
            'captcha_time' => array(
                'type' => 'INT',
                'constraint' => '10',
                'unsigned' => TRUE,
            ),
            'ip_address' => array(
                'type' => 'VARCHAR',
                'constraint' => '45',
            ),
            'word' => array(
                'type' => 'VARCHAR',
                'constraint' => '20',
            ),
        ));

        // Add Primary Key.
        $this->dbforge->add_key("captcha_id", TRUE);

        // Table attributes.

        $attributes = array(
            'ENGINE' => 'InnoDB',
        );

        // Create Table captcha
        $this->dbforge->create_table("captcha", TRUE, $attributes);

    }

    /**
     * down (drop table)
     *
     * @return void
     */
    public function down()
    {
        // Drop table captcha
        $this->dbforge->drop_table("captcha", TRUE);
    }

}
