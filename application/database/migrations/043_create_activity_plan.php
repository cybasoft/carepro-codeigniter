<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_activity_plan extends CI_Migration
{

    /**
     * up (create table)
     *
     * @return void
     */

    public function up()
    {

        $this->meal_plan('activity_plan');
    }

    function meal_plan($table)
    {
        $this->dbforge->add_field([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'room_id'=>[
                'type'=>'INT',
                'constraint'=>11,
                'unsigned'=>TRUE,
                'null'=>TRUE
            ],
            'name'=>[
                'type'=>'VARCHAR',
                'constraint'=>255
            ],
            'description'=>[
                'type'=>'TEXT',
                'null'=>TRUE
            ],
            'activity_date'=>[
                'type'=>'DATE'
            ],
            'activity_start'=>[
                'type'=>'TIME'
            ],
            'activity_end'=>[
                'type'=>'TIME'
            ],
            'user_id'=>[
                'type'=>'INT',
                'constraint'=>11,
                'unsigned'=>TRUE,
                'null'=>TRUE
            ],
            'created_at' => [
                'type' => 'DATETIME'
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => TRUE
            ],
        ]);
        $this->dbforge->add_key("id", TRUE);
        $this->dbforge->create_table($table, TRUE);

        $this->db->query('ALTER TABLE `'.$table.'` ADD FOREIGN KEY (`user_id`) REFERENCES users(`id`) ON DELETE SET NULL ON UPDATE CASCADE');
        $this->db->query('ALTER TABLE `'.$table.'` ADD FOREIGN KEY (`room_id`) REFERENCES child_rooms(`id`) ON DELETE CASCADE ON UPDATE CASCADE');
    }



    /**
     * down (drop table)
     *
     * @return void
     */
    public function down()
    {
        $this->dbforge->drop_table('activity_plan', TRUE);
    }

}
