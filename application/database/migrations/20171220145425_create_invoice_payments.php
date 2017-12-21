<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_invoice_payments extends CI_Migration
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
            'amount' => array(
                'type' => 'FLOAT',
            ),
            'method' => array(
                'type' => 'VARCHAR',
                'constraint' => '50',
            ),
            'remarks' => array(
                'type' => 'TEXT',
            ),
            'user_id' => array(
                'type' => 'INT',
                'constraint' => '11',
            ),
            'created_at' => array(
                'type' => 'DATETIME',
                'null' => TRUE,
            ),
            'date_paid' => array(
                'type' => 'DATE',
            ),
        ));

        // Add Primary Key.
        $this->dbforge->add_key("id", TRUE);

        // Table attributes.

        $attributes = array(
            'ENGINE' => 'InnoDB',
        );

        // Create Table invoice_payments
        $this->dbforge->create_table("invoice_payments", TRUE, $attributes);

    }

    /**
     * down (drop table)
     *
     * @return void
     */
    public function down()
    {
        // Drop table invoice_payments
        $this->dbforge->drop_table("invoice_payments", TRUE);
    }

}
