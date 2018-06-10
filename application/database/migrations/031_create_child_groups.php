<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_child_groups extends CI_Migration
{

    /**
     * up (create table)
     *
     * @return void
     */
    protected $table1 = 'child_groups';
    protected $table2 = 'child_group';

    public function up()
    {
        $this->childGroups();
        $this->childGroup();
    }

    function childGroups()
    {
        $this->dbforge->add_field([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'unique' => TRUE
            ],
            'description' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => TRUE
            ],
            'created_at' => [
                'type' => 'DATETIME'
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => TRUE
            ]
        ]);
        $this->dbforge->add_key("id", TRUE);
        $attributes = array(
            'ENGINE' => 'InnoDB',
        );
        // Create Table users
        $this->dbforge->create_table($this->table1, TRUE, $attributes);
    }

    function childGroup()
    {
        $this->dbforge->add_field([
            'child_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'null'=>FALSE
            ],
            'group_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'null'=>FALSE
            ],
            'created_at' => [
                'type' => 'DATETIME'
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => TRUE
            ]
        ]);
        $this->dbforge->add_key('child_id',true);
        $this->dbforge->add_key('group_id',true);
        $attributes = array(
            'ENGINE' => 'InnoDB',
        );
        // Create Table users
        $this->dbforge->create_table($this->table2, TRUE, $attributes);
        $this->db->query('ALTER TABLE `'.$this->table2.'` ADD FOREIGN KEY (`child_id`) REFERENCES children(`id`) ON DELETE CASCADE ON UPDATE CASCADE');
        $this->db->query('ALTER TABLE `'.$this->table2.'` ADD FOREIGN KEY (`group_id`) REFERENCES child_groups(`id`) ON DELETE CASCADE ON UPDATE CASCADE');
    }

    /**
     * down (drop table)
     *
     * @return void
     */
    public function down()
    {
        $this->dbforge->drop_table($this->table2, TRUE);
        $this->dbforge->drop_table($this->table1, TRUE);
    }

}
