<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Create_Invoices extends CI_Migration
{

    public function up()
    {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'int',
                'constraint' => 5,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'child_id' => array(
                'type' => 'VARCHAR',
                'null' => TRUE
            ),
            'invoice_date' => array(
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => TRUE
            ),
            'invoice_due_date' => array(
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => TRUE
            ),
            'invoice_terms' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'invoice_status' => array(
                'type' => 'INT',
                'null' => TRUE
            )
        ));
        $db->dbforge->add_key('id', TRUE);
        $db->dbforge->create_table('accnt_invoices');

        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',

            )
        ));
    }

    public function down()
    {
        $this->dbforge->drop_table('accnt_invoices');
    }
}