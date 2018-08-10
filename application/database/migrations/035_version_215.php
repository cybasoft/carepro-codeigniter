<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_version_215 extends CI_Migration
{

    /**
     * up (create table)
     *
     * @return void
     */


    public function up()
    {
        $this->roomNotes();
        $this->medPhotos();
        $this->medAdmin();
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


    /**
     * medication admin
     */
    function medAdmin()
    {
        $this->dbforge->add_field(
            [
                'id' => [
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ],
                'med_id' => [
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => TRUE,
                ],
                'user_id' => [
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => TRUE,
                ],
                'child_id' => [
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => TRUE
                ],
                'staff_only' => [
                    'type' => 'TINYINT',
                    'null' => TRUE
                ],
                'remarks' => [
                    'type' => 'VARCHAR',
                    'constraint' => 255
                ],
                'given_at' => [
                    'type' => 'DATETIME',
                    'null' => FALSE
                ],
                'created_at' => [
                    'type' => 'DATETIME',
                ],
            ]
        );
        $this->dbforge->add_key("id", TRUE);
        $this->dbforge->create_table('meds_admin', TRUE);

        $this->db->query('ALTER TABLE `meds_admin` ADD FOREIGN KEY (`med_id`) REFERENCES child_meds(`id`) ON DELETE CASCADE ON UPDATE CASCADE');
        $this->db->query('ALTER TABLE `meds_admin` ADD FOREIGN KEY (`user_id`) REFERENCES users(`id`) ON DELETE CASCADE ON UPDATE CASCADE');
        $this->db->query('ALTER TABLE `meds_admin` ADD FOREIGN KEY (`child_id`) REFERENCES children(`id`) ON DELETE CASCADE ON UPDATE CASCADE');
    }

    function medPhotos()
    {
        $this->dbforge->add_field(
            [
                'id' => [
                    'type' => 'INT',
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

        //add photos to meds table
        $this->dbforge->add_column('child_meds', [
                'photo_id' => [
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => TRUE,
                ]
            ]
        );
    }

    function roomNotes()
    {
        $this->dbforge->add_field(
            [
                'id' => [
                    'type' => 'INT',
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
    }
}