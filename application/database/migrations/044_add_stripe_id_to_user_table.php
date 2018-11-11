<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_stripe_id_to_user_table extends CI_Migration
{

    /**
     * up (create table)
     *
     * @return void
     */
    protected $table = 'users';

    public function up()
    {
        $field1 = array(
            'stripe_customer_id' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => TRUE,
                'unique'=>true
            ),
        );
        $this->dbforge->add_column($this->table, $field1);
    }

    /**
     * down (drop table)
     *
     * @return void
     */
    public function down()
    {
        // Drop table child_allergy
        $this->dbforge->drop_column($this->table, 'stripe_customer_id');
    }

}
