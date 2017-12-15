<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_help_articles extends CI_Migration
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
            'order' => array(
                'type' => 'INT',
                'constraint' => '5',
            ),
            'article_name' => array(
                'type' => 'VARCHAR',
                'constraint' => '50',
            ),
            'article_body' => array(
                'type' => 'TEXT',
            ),
        ));

        // Add Primary Key.
        $this->dbforge->add_key("id", TRUE);

        // Table attributes.

        $attributes = array(
            'ENGINE' => 'MyISAM',
        );

        // Create Table help_articles
        $this->dbforge->create_table("help_articles", TRUE, $attributes);

    }

    /**
     * down (drop table)
     *
     * @return void
     */
    public function down()
    {
        // Drop table help_articles
        $this->dbforge->drop_table("help_articles", TRUE);
    }

}
