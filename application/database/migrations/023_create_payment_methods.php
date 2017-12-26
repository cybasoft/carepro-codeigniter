<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_payment_methods extends CI_Migration
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
                'unsigned'=>TRUE,
                'auto_increment'=>TRUE
            ),
            'title' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null'=>FALSE,
                'unique'=>TRUE
            )
        ));

        // Add Primary Key.
        $this->dbforge->add_key("id", TRUE);

        // Table attributes.

        $attributes = array(
            'ENGINE' => 'InnoDB',
        );

        // Create Table news
        $this->dbforge->create_table("payment_methods", TRUE, $attributes);
    }

    /**
     * down (drop table)
     *
     * @return void
     */
    public function down()
    {
        // Drop table news
        $this->dbforge->drop_table("payment_methods", TRUE);
    }

}
