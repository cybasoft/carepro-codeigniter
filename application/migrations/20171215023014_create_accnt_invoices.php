<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_accnt_invoices extends CI_Migration
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
            'child_id' => array(
                'type' => 'INT',
                'constraint' => '11',
            ),
            'invoice_date' => array(
                'type' => 'VARCHAR',
                'constraint' => '20',
            ),
            'invoice_due_date' => array(
                'type' => 'VARCHAR',
                'constraint' => '20',
            ),
            'invoice_terms' => array(
                'type' => 'TEXT',
            ),
            'invoice_status' => array(
                'type' => 'INT',
                'constraint' => '11',
            ),
        ));

        // Add Primary Key.
        $this->dbforge->add_key("id", TRUE);

        // Table attributes.

        $attributes = array(
            'ENGINE' => 'MyISAM',
        );

        // Create Table accnt_invoices
        $this->dbforge->create_table("accnt_invoices", TRUE, $attributes);

    }

    /**
     * down (drop table)
     *
     * @return void
     */
    public function down()
    {
        // Drop table accnt_invoices
        $this->dbforge->drop_table("accnt_invoices", TRUE);
    }

}
