<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_update_invoice_status extends CI_Migration
{

    /**
     * up (create table)
     *
     * @return void
     */
    protected $table = 'invoices';

    public function up()
    {
        $this->db->query('ALTER TABLE invoices MODIFY invoice_status VARCHAR(100) NOT NULL;');
    }

    /**
     * down (drop table)
     *
     * @return void
     */
    public function down()
    {
        // Drop table child_allergy
        $this->db->query('ALTER TABLE invoices MODIFY invoice_status INT(11) NOT NULL;');
    }

}
