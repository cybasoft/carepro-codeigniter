<?php

defined('BASEPATH') or exit('No direct script access allowed');

class SubscriptionTableSeeder extends CI_Migration
{

    public function run()
    {
        $plan_details = [
            [
                'plan' => 'basic',
                'price' => 35
            ],
            [
                'plan' => 'silver',
                'price' => 59.99
            ],
            [
                'plan' => 'gold',
                'price' => 120
            ],
        ];

        foreach ($plan_details as $plans) {
            $this->db->insert('subscription_plans', $plans);
        }
    }
}
