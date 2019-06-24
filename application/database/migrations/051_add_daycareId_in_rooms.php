<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_daycareId_in_rooms extends CI_Migration
{

    /**
     * up (create table)
     *
     * @return void
     */
    protected $table1 = 'child_room';
    protected $table2 = 'child_rooms';

    public function up()
    {
        $field1 = array(
            'daycare_id' => array(
                'type' => 'INT',
                'constraint' => 11,                
                'unsigned'=>TRUE
            )
        );
        $this->dbforge->add_column($this->table1, $field1, 'room_id');
        $this->dbforge->add_column($this->table2, $field1, 'description');

        $this->db->query('ALTER TABLE `child_room` ADD FOREIGN KEY (`daycare_id`) REFERENCES daycare(`id`) ON DELETE CASCADE ON UPDATE CASCADE');
        $this->db->query('ALTER TABLE `child_rooms` ADD FOREIGN KEY (`daycare_id`) REFERENCES daycare(`id`) ON DELETE CASCADE ON UPDATE CASCADE');
    }

    /**
     * down (drop table)
     *
     * @return void
     */
    public function down()
    {
        // Drop table child_allergy
        $this->dbforge->drop_column($this->table1, 'daycare_id');
        $this->dbforge->drop_column($this->table2, 'daycare_id');
    }

}
