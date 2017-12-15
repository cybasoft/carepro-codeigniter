<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_accnt_pay_bank extends CI_Migration
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
            'bank_name' => array(
                'type' => 'VARCHAR',
                'constraint' => '50',
            ),
            'account_no' => array(
                'type' => 'BLOB',
            ),
            'routing' => array(
                'type' => 'INT',
                'constraint' => '20',
            ),
        ));

        // Add Primary Key.
        $this->dbforge->add_key("id", TRUE);

        // Table attributes.

        $attributes = array(
            'ENGINE' => 'MyISAM',
        );

        // Create Table accnt_pay_bank
        $this->dbforge->create_table("accnt_pay_bank", TRUE, $attributes);

    }

    /**
     * down (drop table)
     *
     * @return void
     */
    public function down()
    {
        // Drop table accnt_pay_bank
        $this->dbforge->drop_table("accnt_pay_bank", TRUE);
    }

}
