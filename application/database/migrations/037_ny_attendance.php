<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_ny_attendance extends CI_Migration
{
    /**
     * up (create table)
     *
     * @return void
     */
    protected $table = 'form_ny_attendance';

    public function up()
    {
        $this->dbforge->add_field(
        [
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned'=>TRUE,
                'auto_increment'=>TRUE
            ],
            'child_id'=>[
                'type'=>'INT',
                'constraint'=>11,
                'unsigned'=>TRUE
            ],
            'food'=>[ //'B','AM','L','PM','S','EV'
                'type'=>'VARCHAR',
                'constraint'=>255,
                'null'=>TRUE
            ],
            'checkinout'=>[ //absent if no data | {in:'12:00',out:'2:00',in-2:'3:00',out-2:'4:00'}
                'type'=>'VARCHAR',
                'constraint'=>255,
                'null'=>TRUE
            ],
            'healthcheck'=>[
                'type'=>'TINYINT',
                'null'=>true
            ],
            'created_at' => array(
                'type' => 'DATE',
            ),
            'updated_at' => array(
                'type' => 'DATETIME',
            ),
        ]
        );
        $this->dbforge->add_key("id", TRUE);
        $attributes = array(
            'ENGINE' => 'InnoDB',
        );
        // Create Table users
        $this->dbforge->create_table($this->table, TRUE, $attributes);
        $this->db->query('ALTER TABLE `'.$this->table.'` ADD FOREIGN KEY (`child_id`) REFERENCES children(`id`) ON DELETE CASCADE ON UPDATE CASCADE');
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