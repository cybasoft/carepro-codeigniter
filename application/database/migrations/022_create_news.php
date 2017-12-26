<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_news extends CI_Migration
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
            'user_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned'=>TRUE
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
            'publish_date' => array(
                'type' => 'DATETIME'
            ),
        ));

        // Add Primary Key.
        $this->dbforge->add_key("id", TRUE);

        // Table attributes.

        $attributes = array(
            'ENGINE' => 'InnoDB',
        );

        // Create Table news
        $this->dbforge->create_table("news", TRUE, $attributes);
        $this->db->query('ALTER TABLE `news` ADD FOREIGN KEY (`user_id`) REFERENCES users(`id`) ON DELETE CASCADE ON UPDATE CASCADE');
    }

    /**
     * down (drop table)
     *
     * @return void
     */
    public function down()
    {
        // Drop table news
        $this->dbforge->drop_table("news", TRUE);
    }

}
