<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_photos extends CI_Migration
{

    /**
     * up (create table)
     *
     * @return void
     */
    protected $table = 'photos';

    public function up()
    {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned'=>TRUE,
                'auto_increment'=>TRUE
            ),
            'child_id'=>array(
                'type'=>'INT',
                'unsigned'=>TRUE,
                'constraint' => 11,
            ),
            'name'=>array(
                'type'=>'VARCHAR',
                'constraint'=>100
            ),
            'caption'=>array(
                'type'=>'VARCHAR',
                'constraint'=>100
            ),
            'position'=>array(
                'type'=>'INT',
                'constraint'=>11
            ),
            'category'=>array(
                'type'=>'VARCHAR',
                'constraint'=>50,
                'null'=>TRUE
            ),
            'uploaded_by'=>array(
                'type'=>'INT',
                'unsigned'=>TRUE,
                'constraint' => 11,
            ),
            'created_at' => array(
                'type' => 'DATETIME',
            ),
        ));
        $this->dbforge->add_key("id", TRUE);
        $attributes = array(
            'ENGINE' => 'InnoDB',
        );
        // Create Table users
        $this->dbforge->create_table($this->table, TRUE, $attributes);

        $this->db->query('ALTER TABLE `'.$this->table.'` ADD FOREIGN KEY (`child_id`) REFERENCES children(`id`) ON DELETE CASCADE ON UPDATE CASCADE');
        $this->db->query('ALTER TABLE `'.$this->table.'` ADD FOREIGN KEY (`uploaded_by`) REFERENCES users(`id`) ON DELETE CASCADE ON UPDATE CASCADE');
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
