<?php

class CalendarTableSeeder extends CI_Model
{

    public function __construct($limit = 5)
    {
    }

    public function run($limit = 5)
    {

        $faker = Faker\Factory::create();

        echo 'Cleaning up...'.PHP_EOL;

        $this->db->truncate('calendar');

        echo 'Creating events...'.PHP_EOL;
        for ($i = 0; $i <= $limit; $i++) {
            $start = date('Y-m-d', strtotime('today +'.rand($i,$limit).' days'));
            $end = date('Y-m-d', strtotime($start.' +1 hour'));
            $hour = mt_rand(7, 17);
            $this->db->insert('calendar', [
                'title' => $faker->sentence(2),
                'start' => $start,
                'end' => $end,
                'start_t' => $hour.":00",
                'end_t' => ($hour+1).":00",
                'user_id' => 1,
                'daycare_id' => 1,
                'description' => $faker->sentence(7),
                'created_at' => date_stamp(),

            ]);
        }

        echo 'Calendar seeding done'.PHP_EOL;
    }
}
