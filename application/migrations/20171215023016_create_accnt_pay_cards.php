<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_accnt_pay_cards extends CI_Migration
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
            'name_on_card' => array(
                'type' => 'VARCHAR',
                'constraint' => '50',
            ),
            'card_no' => array(
                'type' => 'BLOB',
            ),
            'expiry' => array(
                'type' => 'VARCHAR',
                'constraint' => '10',
            ),
            'ccv' => array(
                'type' => 'BLOB',
            ),
        ));

        // Add Primary Key.
        $this->dbforge->add_key("id", TRUE);

        // Table attributes.

        $attributes = array(
            'ENGINE' => 'MyISAM',
        );

        // Create Table accnt_pay_cards
        $this->dbforge->create_table("accnt_pay_cards", TRUE, $attributes);

    }

    /**
     * down (drop table)
     *
     * @return void
     */
    public function down()
    {
        // Drop table accnt_pay_cards
        $this->dbforge->drop_table("accnt_pay_cards", TRUE);
    }

}
