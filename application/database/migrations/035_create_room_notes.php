<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_room_notes extends CI_Migration
{
    /**
     * up (create table)
     *
     * @return void
     */

    protected $table = 'child_room_notes';

    public function up()
    {
        $this->dbforge->add_field(
            [
                'id' => [
                    'type' => 'BIGINT',
                    'constraint' => 11,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ],
                'user_id' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => TRUE,
                ),
                'room_id' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => TRUE,
                ),
                'content' => array(
                    'type' => 'LONGTEXT',
                    'null' => true
                ),
                'created_at' => array(
                    'type' => 'DATETIME',
                ),
            ]
        );
        $this->dbforge->add_key("id", TRUE);
        $this->dbforge->create_table($this->table, TRUE);

        $this->db->query('ALTER TABLE '.$this->table.' ADD FOREIGN KEY (`user_id`) REFERENCES users(`id`) ON DELETE CASCADE ON UPDATE CASCADE');
        $this->db->query('ALTER TABLE '.$this->table.' ADD FOREIGN KEY (`room_id`) REFERENCES child_rooms(`id`) ON DELETE CASCADE ON UPDATE CASCADE');
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