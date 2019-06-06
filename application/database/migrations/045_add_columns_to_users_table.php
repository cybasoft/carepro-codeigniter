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
            'address_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned'=>TRUE,
                'after' => 'password'
            ),
            'owner_status' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => TRUE,
            ),
            'selected_plan' => array(
                'type'  => 'INT',
                'constraint' => '11',
                'unsigned'=>TRUE
            ),
            'daycare_id' => array(
                'type'  => 'INT',
                'constraint' => '11',
                'unsigned'=>TRUE
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
