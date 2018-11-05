<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_food_plan extends CI_Migration
{

    /**
     * up (create table)
     *
     * @return void
     */

    public function up()
    {

        $this->meal_plan('meal_plan');
        $this->meal_plan_types('meal_plan_types');
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
            'meal_type'=>[
                'type'=>'INT',
                'constraint'=>11,
                'unsigned'=>TRUE
            ],
            'name'=>[
                'type'=>'VARCHAR',
                'constraint'=>255
            ],
            'meal_date'=>[
                'type'=>'DATE'
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

    function meal_plan_types($table)
    {
        $this->dbforge->add_field([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'name'=>[
                'type'=>'VARCHAR',
                'constraint'=>255,
                'null'=>TRUE
            ]
        ]);
        $this->dbforge->add_key("id", TRUE);
        $this->dbforge->create_table($table, TRUE);

        $types = ['breakfast','AM Snack','Lunch','PM Snack','Supper'];
        foreach($types as $type){
            $this->db->insert($table,['name'=>$type]);
        }
    }

    /**
     * down (drop table)
     *
     * @return void
     */
    public function down()
    {
        $this->dbforge->drop_table('meal_plan_types', TRUE);
        $this->dbforge->drop_table('meal_plan', TRUE);
    }

}
