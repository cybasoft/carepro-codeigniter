<?php

class RoomsTableSeeder extends CI_Model
{

    public function __construct($limit = 5)
    { }

    public function run($limit = 5)
    {

        $faker = Faker\Factory::create();

        echo 'Cleaning up...' . PHP_EOL;

        $this->db->truncate('child_room');
        $this->db->truncate('child_room_staff');
        $this->db->truncate('child_room_staff');
        $this->db->truncate('child_rooms');


        echo 'Creating rooms...' . PHP_EOL;
        for ($i = 1; $i <= $limit; $i++) {
            $this->db->insert('child_rooms', [
                'name' => $faker->word . ' ' . $faker->word,
                'description' => $faker->sentence(7),
                'daycare_id' => 1
            ]);
        }

        $rooms = $this->db->count_all_results('child_rooms');

        $children = $this->db->get('children')->result();
        foreach ($children as $child) {
            $this->db->insert('child_room', [
                'child_id' => $child->id,
                'room_id' => rand(1, $rooms),
                'created_at' => date_stamp(),
                'updated_at' => date_stamp(),
                'daycare_id' => 1
            ]);
        }
        $staffs = $this->db->select(
              'users.id,users.daycare_id,users.name,
               users.first_name,users.last_name,users_groups.group_id'
            )->where([
                'daycare_id' => 1,
                'users_groups.group_id' => 3,
                'active' => 1
            ])->from('users')
            ->join('users_groups', 'users_groups.user_id=users.id')
            ->get()->result();
        foreach ($staffs as $staff) {
            $this->db->insert('child_room_staff', [
                'user_id' => $staff->id,
                'room_id' => rand(1, $rooms),
                'created_at' => date_stamp(),
                'updated_at' => date_stamp()
            ]);
        }

        echo 'Rooms seeding done' . PHP_EOL;
    }
}
