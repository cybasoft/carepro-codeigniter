<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_nickname_to_child extends CI_Migration
{

    /**
     * up (create table)
     *
     * @return void
     */
    protected $table = 'children';

    public function up()
    {
        $field1 = array(
            'nickname' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => TRUE,
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
        $this->dbforge->drop_column($this->table, 'nickname');
    }

}
