<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_key_to_user_daycare_table extends CI_Migration
{
    /**
     * up (create table)
     *
     * @return void
     */
    public function up()
    {
        $this->db->query('ALTER TABLE `users` ADD FOREIGN KEY (`address_id`) REFERENCES address(`id`) ON DELETE CASCADE ON UPDATE CASCADE');
        $this->db->query('ALTER TABLE `daycare` ADD FOREIGN KEY (`address_id`) REFERENCES address(`id`) ON DELETE CASCADE ON UPDATE CASCADE');
    }
}