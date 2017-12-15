<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_accnt_invoice_payments extends CI_Migration
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
            'invoice_id' => array(
                'type' => 'INT',
                'constraint' => '11',
            ),
            'amount_paid' => array(
                'type' => 'INT',
                'constraint' => '11',
            ),
            'date_paid' => array(
                'type' => 'VARCHAR',
                'constraint' => '20',
            ),
            'method' => array(
                'type' => 'VARCHAR',
                'constraint' => '50',
            ),
            'remarks' => array(
                'type' => 'TEXT',
            ),
        ));

        // Add Primary Key.
        $this->dbforge->add_key("id", TRUE);

        // Table attributes.

        $attributes = array(
            'ENGINE' => 'MyISAM',
        );

        // Create Table accnt_invoice_payments
        $this->dbforge->create_table("accnt_invoice_payments", TRUE, $attributes);

    }

    /**
     * down (drop table)
     *
     * @return void
     */
    public function down()
    {
        // Drop table accnt_invoice_payments
        $this->dbforge->drop_table("accnt_invoice_payments", TRUE);
    }

}
