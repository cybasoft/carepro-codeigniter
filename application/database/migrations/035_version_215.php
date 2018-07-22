<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_version_215 extends CI_Migration
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
        $this->dbforge->create_table('child_room_notes', TRUE);

        $this->db->query('ALTER TABLE child_room_notes ADD FOREIGN KEY (`user_id`) REFERENCES users(`id`) ON DELETE CASCADE ON UPDATE CASCADE');
        $this->db->query('ALTER TABLE child_room_notes ADD FOREIGN KEY (`room_id`) REFERENCES child_rooms(`id`) ON DELETE CASCADE ON UPDATE CASCADE');

        //add med photos database
        $this->dbforge->add_field(
            [
                'id' => [
                    'type' => 'BIGINT',
                    'constraint' => 11,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ],
                'name' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '255',
                    'null' => FALSE,
                ),
                'photo' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '255',
                    'null' => FALSE
                ),
                'created_at' => array(
                    'type' => 'DATETIME',
                ),
            ]
        );
        $this->dbforge->add_key("id", TRUE);
        $this->dbforge->create_table('med_photos', TRUE);

        //add photos to meds
        $this->dbforge->add_column('child_meds', [
                'photo_id' => [
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => TRUE,
                ]
            ]
        );

    }

    /**
     * down (drop table)
     *
     * @return void
     */
    public function down()
    {
        $this->dbforge->drop_table('child_room_notes', TRUE);

        $this->dbforge->drop_column('child_meds', 'photo_id');

        $this->dbforge->drop_table('med_photos', TRUE);
    }

}