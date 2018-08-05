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
        $this->notesGroups();
        $this->childFoodIntake();
        $this->dbBackup();
    }


    /**
     * down (drop table)
     *
     * @return void
     */
    public function down()
    {
        $this->dbforge->drop_table('db_backup', TRUE);
        $this->dbforge->drop_table('child_food_intake', TRUE);
        $this->dbforge->drop_table('notes_categories', TRUE);
        $this->dbforge->drop_column('child_notes', 'category_id');
        $this->dbforge->drop_column('child_notes', 'tags');
        $this->dbforge->drop_table('med_admin', TRUE);
        $this->dbforge->drop_table('child_room_notes', TRUE);
        $this->dbforge->drop_column('child_meds', 'photo_id');
        $this->dbforge->drop_table('med_photos', TRUE);
    }

    function dbBackup(){

        $table = 'db_backup';

        $this->dbforge->add_field(
            [
                'id' => [
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ],
                'name'=>[
                    'type'=>'VARCHAR',
                    'constraint'=>255,
                    'null'=>false
                ],
                'created_at' => [
                    'type' => 'DATETIME'
                ],
            ]);
        $this->dbforge->add_key("id", TRUE);
        $this->dbforge->create_table($table, TRUE);

    }
    function childFoodIntake()
    {
        $table = 'child_food_intake';

        $this->dbforge->add_field(
            [
                'id' => [
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ],
                'user_id' => [
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => TRUE,
                ],
                'child_id' => [
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => TRUE,
                ],
                'meal_time'=>[
                    'type'=>'VARCHAR',
                    'constraint'=>50,
                    'null'=>false
                ],
                'quantity'=>[
                    'type'=>'VARCHAR',
                    'constraint'=>50,
                    'null'=>false
                ],
                'remarks'=>[
                    'type'=>'VARCHAR',
                    'constraint'=>255,
                    'null'=>true
                ],
                'taken_at' => [
                    'type' => 'DATETIME'
                ],
            ]);
        $this->dbforge->add_key("id", TRUE);
        $this->dbforge->create_table($table, TRUE);

        $this->db->query('ALTER TABLE '.$table.' ADD FOREIGN KEY (`user_id`) REFERENCES users(`id`) ON DELETE CASCADE ON UPDATE CASCADE');
        $this->db->query('ALTER TABLE '.$table.' ADD FOREIGN KEY (`child_id`) REFERENCES children(`id`) ON DELETE CASCADE ON UPDATE CASCADE');

    }

    function notesGroups()
    {
        //categories
        $this->dbforge->add_field(
            [
                'id' => [
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ],
                'name' => [
                    'type' => 'VARCHAR',
                    'constraint' => 255,
                    'null' => FALSE
                ]
            ]
        );
        $this->dbforge->add_key("id", TRUE);
        $this->dbforge->create_table('notes_categories', TRUE);

        $defaultCats = ['Academics', 'Arts & Crafts', 'Circle Time', 'Physical Fitness', 'Play Time', 'Quiet Time', 'Sensory Learning'];

        foreach ($defaultCats as $cat) {
            $this->db->insert('notes_categories', ['name' => $cat]);
        }

        //tags
        $this->dbforge->add_field(
            [
                'id' => [
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ],
                'name' => [
                    'type' => 'VARCHAR',
                    'constraint' => 255,
                    'null' => FALSE
                ]
            ]
        );
        $this->dbforge->add_key("id", TRUE);
        $this->dbforge->create_table('notes_tags', TRUE);

        $defaultTags = ['General', 'Cognitive', 'Fine Motor', 'Language', 'Math', 'Science', 'Social'];

        foreach ($defaultTags as $tag) {
            $this->db->insert('notes_tags', ['name', $tag]);
        }

        //add relation to child_notes
        $this->dbforge->add_column('child_notes', [
                'category_id' => [
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => TRUE
                ],
                'tags' => [
                    'type' => 'VARCHAR',
                    'constraint' => 255,
                    'unsigned' => TRUE,
                ]
            ]
        );
        $this->db->query('ALTER TABLE `child_notes` ADD FOREIGN KEY (`category_id`) REFERENCES notes_categories(`id`) ON DELETE CASCADE ON UPDATE CASCADE');

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