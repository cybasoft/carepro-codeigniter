<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_options extends CI_Migration
{
    /**
     * up (create table)
     *
     * @return void
     */
    protected $table = 'options';

    public function up()
    {
        $this->dbforge->add_field(
        [
            'id' => [
                'type' => 'BIGINT',
                'constraint' => 11,
                'unsigned'=>TRUE,
                'auto_increment'=>TRUE
            ],
            'option_name' => array(
                'type' => 'VARCHAR',
                'constraint'=>191,
                'unique'=>true,
                'null'=>false
            ),
            'option_value' => array(
                'type' => 'LONGTEXT',
                'null'=>true
            ),
            'autoload'=>array(
                'type'=>'VARCHAR',
                'constraint'=>20,
                'null'=>true
            )
        ]
        );
        $this->dbforge->add_key("id", TRUE);
        $attributes = array(
            'ENGINE' => 'InnoDB',
        );
        // Create Table users
        $this->dbforge->create_table($this->table, TRUE, $attributes);
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