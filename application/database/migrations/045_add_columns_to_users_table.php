<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_columns_to_users_table extends CI_Migration
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
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'after' => 'last_name'
            ),
            'address_line_1' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'after' => 'password'
            ),
            'address_line_2' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null'=>TRUE,
                'after' => 'address_line_1'
            ),
            'city' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'after' => 'address_line_2'
            ),
            'state' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'after' => 'city'
            ),
            'country' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'after' => 'state'
            ),
            'owner_status' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => TRUE,
            ),
            'selected_plan' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => TRUE,
            ),
            'daycare_id' => array(
                'type'  => 'VARCHAR',
                'constraint' => '100',
                'null' => TRUE,
            ),
            'updated_at' => [
                'type' => 'TIMESTAMP',
            ],
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
        $this->dbforge->drop_column($this->table, 'name','address_line_1','address_line_2','city','state','country');
    }

}
