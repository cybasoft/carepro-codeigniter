<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_child_room_staff extends CI_Migration
{
    /**
     * up (create table)
     *
     * @return void
     */
    protected $table = 'child_room_staff';

    public function up()
    {
        $this->dbforge->add_field(
            [
                'user_id' => [
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => TRUE,
                    'null' => FALSE
                ],
                'room_id' => [
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => TRUE,
                    'null' => FALSE
                ],
                'created_at' => array(
                    'type' => 'DATETIME',
                ),
                'updated_at' => array(
                    'type' => 'DATETIME',
                ),
            ]
        );
        $this->dbforge->add_key('user_id', TRUE);
        $this->dbforge->add_key('room_id', TRUE);
        $attributes = array(
            'ENGINE' => 'InnoDB',
        );
        // Create Table users
        $this->dbforge->create_table($this->table, TRUE, $attributes);
        $this->db->query('ALTER TABLE `'.$this->table.'` ADD FOREIGN KEY (`user_id`) REFERENCES users(`id`) ON DELETE CASCADE ON UPDATE CASCADE');
        $this->db->query('ALTER TABLE `'.$this->table.'` ADD FOREIGN KEY (`room_id`) REFERENCES child_rooms(`id`) ON DELETE CASCADE ON UPDATE CASCADE');
    }

    /**
     * down (drop table)
     *
     * @return void
     */
    public function down()
    {
        $this->dbforge->drop_table($this->table, TRUE);
    }

}