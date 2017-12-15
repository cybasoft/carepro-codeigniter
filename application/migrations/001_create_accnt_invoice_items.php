<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_accnt_invoice_items extends CI_Migration
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
            'item_name' => array(
                'type' => 'VARCHAR',
                'constraint' => '50',
            ),
            'item_description' => array(
                'type' => 'TEXT',
            ),
            'item_price' => array(
                'type' => 'INT',
                'constraint' => '11',
            ),
            'item_quantity' => array(
                'type' => 'INT',
                'constraint' => '11',
            ),
            'item_discount' => array(
                'type' => 'INT',
                'constraint' => '11',
            ),
            'staff_id' => array(
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

        // Create Table accnt_invoice_items
        $this->dbforge->create_table("accnt_invoice_items", TRUE, $attributes);

    }

    /**
     * down (drop table)
     *
     * @return void
     */
    public function down()
    {
        // Drop table accnt_invoice_items
        $this->dbforge->drop_table("accnt_invoice_items", TRUE);
    }

}
