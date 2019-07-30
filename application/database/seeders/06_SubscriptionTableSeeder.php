<?php

defined('BASEPATH') or exit('No direct script access allowed');

class SubscriptionTableSeeder extends CI_Migration
{

    public function run()
    {
        $this->db->truncate('subscription_plans');
        $plan_details = [
            [
                'plan' => 'basic',
                'children' => 10,
                'staff_members' => 5,
                'calender_events' => 20,
                'news_module' => 'Yes',
                'rooms' => 'Yes',
                'invoices' => 30,
                'files' => 'No',
                'price' => 35
            ],
            [
                'plan' => 'silver',
                'children' => 20,
                'staff_members' => 10,
                'calender_events' => 50,
                'news_module' => 'Yes',
                'rooms' => 'Yes',
                'invoices' => 100,
                'files' => '250MB',
                'price' => 59.99
            ],
            [
                'plan' => 'gold',
                'children' => 'Unlimited',
                'staff_members' => 'Unlimited',
                'calender_events' => 'Unlimited',
                'news_module' => 'Yes',
                'rooms' => 'Yes',
                'invoices' => 'Unlimited',
                'files' => '2GB',
                'price' => 120
            ],
        ];

        foreach ($plan_details as $plans) {
            $this->db->insert('subscription_plans', $plans);
        }
    }
}
