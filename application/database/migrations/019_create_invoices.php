<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_invoices extends CI_Migration
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
            'child_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned'=>TRUE
            ),
            'date_due' => array(
                'type' => 'DATE',
            ),
            'invoice_terms' => array(
                'type' => 'TEXT',
                'null' => TRUE,
            ),
            'invoice_status' => array(
                'type' => 'INT',
                'constraint' => 11,
            ),
            'user_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned'=>TRUE
            ),
            'created_at' => array(
                'type' => 'DATETIME',
            ),
        ));

        // Add Primary Key.
        $this->dbforge->add_key("id", TRUE);

        // Table attributes.

        $attributes = array(
            'ENGINE' => 'InnoDB',
        );

        // Create Table invoices
        $this->dbforge->create_table("invoices", TRUE, $attributes);
        $this->db->query('ALTER TABLE `invoices` ADD FOREIGN KEY (`child_id`) REFERENCES children(`id`) ON DELETE CASCADE ON UPDATE CASCADE');
        $this->db->query('ALTER TABLE `invoices` ADD FOREIGN KEY (`user_id`) REFERENCES users(`id`) ON DELETE RESTRICT ON UPDATE CASCADE');

    }

    /**
     * down (drop table)
     *
     * @return void
     */
    public function down()
    {
        // Drop table invoices
        $this->dbforge->drop_table("invoices", TRUE);
    }

}
