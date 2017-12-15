<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_inbox_reply extends CI_Migration
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
                'constraint' => '11',
            ),
            'sender' => array(
                'type' => 'VARCHAR',
                'constraint' => '10',
            ),
            'parent' => array(
                'type' => 'VARCHAR',
                'constraint' => '20',
            ),
            'message' => array(
                'type' => 'TEXT',
            ),
            'date_sent' => array(
                'type' => 'VARCHAR',
                'constraint' => '20',
            ),
            'is_read' => array(
                'type' => 'INT',
                'constraint' => '5',
            ),
        ));

        // Add Primary Key.
        $this->dbforge->add_key("id", TRUE);

        // Table attributes.

        $attributes = array(
            'ENGINE' => 'InnoDB',
        );

        // Create Table inbox_reply
        $this->dbforge->create_table("inbox_reply", TRUE, $attributes);

    }

    /**
     * down (drop table)
     *
     * @return void
     */
    public function down()
    {
        // Drop table inbox_reply
        $this->dbforge->drop_table("inbox_reply", TRUE);
    }

}
