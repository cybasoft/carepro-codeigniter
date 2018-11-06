<?php

class ChildrenTableSeeder extends CI_Model
{

    public function __construct($limit = 25)
    {
    }

    public function run($limit = 25)
    {

        $faker = Faker\Factory::create();

        $parents = $this->db->select('ug.user_id')
            ->from('users AS u')
            ->join('users_groups AS ug', 'ug.user_id=u.id')
            ->where('ug.group_id', 4)
            ->get()->result();

        $pids = [];

        foreach ($parents as $parent) {
            $pids[] = $parent->user_id;
        }

        echo 'Cleaning up...'.PHP_EOL;

        $this->db->truncate('child_parents');
        $this->db->truncate('children');

        $photos = [];
        foreach (scandir(APPPATH.'../assets/uploads/children') as $file) {
            if(pathinfo($file, PATHINFO_EXTENSION) == 'jpg' || pathinfo($file, PATHINFO_EXTENSION) == 'png') {
                //delete
//                @unlink(APPPATH.'../assets/uploads/children/'.$file);
                //reuse
                $photos[] = $file;
            }
        }

        echo 'Generating data...'.PHP_EOL;

        for ($i = 1; $i <= $limit; $i++) {
            $data = [
                'nickname' => $faker->username,
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'national_id' => encrypt(rand(123456, 999999)),
                'bday' => date('Y-m-d'),
                'gender' => 'M',
                'last_update' => date_stamp(),
                'status' => 1,
                'created_at' => date_stamp(),
                'user_id' => 1,
                'photo' => count($photos) > 0 ? $photos[rand(0, count($photos)-1)] : '',
            ];

            $this->db->insert('children', $data);
            $id = $this->db->insert_id();

            //associate with parents;
            if(count($pids) > 0) {
                $parent = $pids[rand(0, count($pids) - 1)];

                echo 'Assigning parent with ID '.$parent.PHP_EOL;

                if($parent > 0) {
                    $this->db->insert('child_parents', ['user_id' => $parent, 'child_id' => $id]);
                }
            } else {
                echo 'Child '.$id.' has not been assinged to a parent'.PHP_EOL;
            }
        }
    }
}
