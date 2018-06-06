<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_child_demographics extends CI_Migration
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
            'ethnicity' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => TRUE,
            ),
        );
        $this->dbforge->add_column($this->table, $field1);

        $field2 = array(
            'religion' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => TRUE,
            ),
        );
        $this->dbforge->add_column($this->table, $field2);

        $field3 = array(
            'birthplace' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => TRUE,
            ),
        );
        $this->dbforge->add_column($this->table, $field3);
    }

    /**
     * down (drop table)
     *
     * @return void
     */
    public function down()
    {
        // Drop table child_allergy
        $this->dbforge->drop_column($this->table, 'ethnicity');
        $this->dbforge->drop_column($this->table, 'religion');
        $this->dbforge->drop_column($this->table, 'birthplace');
    }

}
