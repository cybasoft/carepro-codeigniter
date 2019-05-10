<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_foreign_key_to_users_table extends CI_Migration
{
    /**
     * up (create table)
     *
     * @return void
     */
    protected $table = 'users';

    public function up()
    {
        $this->db->query('ALTER TABLE `'.$this->table.'` ADD FOREIGN KEY (`daycare_id`) REFERENCES daycare(`id`) ON DELETE CASCADE ON UPDATE CASCADE');
    }
}