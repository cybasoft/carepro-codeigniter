<?php defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Add_children_checkin extends CI_Migration
{

    /**
     * up (create table)
     *
     * @return void
     */
    public function up()
    {

        $this->dbforge->add_column('children',
            [
                'checkin_status' => array(
                    'type' => 'INT',
                    'constraint' => '11',
                    'null' => false,
                    'default'=>'0'
                ),
            ]);

    }

    /**
     * down (drop table)
     *
     * @return void
     */
    public function down()
    {

    }

}
