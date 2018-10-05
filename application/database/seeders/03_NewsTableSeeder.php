<?php
class NewsTableSeeder extends CI_Model
{
    public function __construct($limit = 25)
    {
    }

    public function run($limit = 25)
    {
        $faker = Faker\Factory::create();

        $this->db->truncate('news');
        $this->db->truncate('news_categories');

        $categories = [
            'default',
            'weekly',
            'alerts',
            'updates',
            'meetings',
        ];
        foreach ($categories as $category){
            $this->db->insert('news_categories',['name'=>$category]);
        }

        for ($i = 1; $i <= $limit; $i++) {
            $data = [
                'title' => $faker->text(50),
                'content'=>$faker->text(1000),
                'list_order'=>$i,
                'category_id'=>rand(1,5),
                'publish_date' => date_stamp(),
                'created_at' => date_stamp(),
                'status' => 'published',
                'user_id' => 1,
            ];

            $this->db->insert('news', $data);
        }

        echo 'News seeding done'.PHP_EOL;
    }
}
