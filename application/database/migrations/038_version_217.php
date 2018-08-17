<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_version_217 extends CI_Migration
{
    /**
     * up (create table)
     *
     * @return void
     */
    protected $table = 'form_ny_attendance';

    public function up()
    {
        if (!$this->db->field_exists('list_order', 'news'))
            $this->db->query('ALTER TABLE news ADD COLUMN list_order INT(5);');
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