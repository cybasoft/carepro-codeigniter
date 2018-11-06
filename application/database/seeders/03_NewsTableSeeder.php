<?php

class NewsTableSeeder extends CI_Model
{

    public function __construct($limit = 25)
    {
    }

    public function run($limit = 25)
    {

        $faker = Faker\Factory::create();

        echo 'Cleaning up...'.PHP_EOL;

        $this->db->truncate('news');
        $this->db->truncate('news_categories');

        $categories = [
            'default',
            'weekly',
            'alerts',
            'updates',
            'meetings',
        ];
        echo 'Creating categories...'.PHP_EOL;
        foreach ($categories as $category) {
            $this->db->insert('news_categories', ['name' => $category]);
        }


        echo 'Creating news...'.PHP_EOL;
        for ($i = 1; $i <= $limit; $i++) {
            $this->db->insert('news',
                [
                    'title' => $faker->text(50),
                    'content' => $faker->text(1000),
                    'list_order' => $i,
                    'category_id' => rand(1, 5),
                    'publish_date' => date_stamp(),
                    'created_at' => date_stamp(),
                    'status' => 'published',
                    'user_id' => 1
                ]
            );
        }
        echo 'News seeding done'.PHP_EOL;
    }
}
