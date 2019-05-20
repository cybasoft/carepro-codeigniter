<?php

defined('BASEPATH') or exit('No direct script access allowed');

class UserStatusSeeder extends CI_Migration
{

    public function run()
    {
        $this->db->truncate('user_status');
        $user_status = [
            [
                'status' => 'draft',                
            ],
            [
                'status' => 'confirmed',                
            ],
            [
                'status' => 'subscribed',                
            ],
            [
                'status' => 'registered',                
            ],
        ];

        foreach ($user_status as $user) {
            $this->db->insert('user_status', $user);
        }
    }
}
