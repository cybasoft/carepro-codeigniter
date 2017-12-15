<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_inbox extends CI_Migration
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
            'msg_id' => array(
                'type' => 'VARCHAR',
                'constraint' => '50',
            ),
            'sender' => array(
                'type' => 'INT',
                'constraint' => '10',
            ),
            'receiver' => array(
                'type' => 'INT',
                'constraint' => '11',
            ),
            'subject' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
            'message' => array(
                'type' => 'TEXT',
            ),
            'date_sent' => array(
                'type' => 'VARCHAR',
                'constraint' => '20',
            ),
            'receiver_read' => array(
                'type' => 'INT',
                'constraint' => '10',
            ),
            'sender_read' => array(
                'type' => 'INT',
                'constraint' => '11',
            ),
            'sender_loc' => array(
                'type' => 'VARCHAR',
                'constraint' => '20',
            ),
            'receiver_loc' => array(
                'type' => 'VARCHAR',
                'constraint' => '20',
            ),
            'location' => array(
                'type' => 'VARCHAR',
                'constraint' => '10',
            ),
        ));

        // Add Primary Key.
        $this->dbforge->add_key("id", TRUE);

        // Table attributes.

        $attributes = array(
            'ENGINE' => 'MyISAM',
        );

        // Create Table inbox
        $this->dbforge->create_table("inbox", TRUE, $attributes);

    }

    /**
     * down (drop table)
     *
     * @return void
     */
    public function down()
    {
        // Drop table inbox
        $this->dbforge->drop_table("inbox", TRUE);
    }

}
