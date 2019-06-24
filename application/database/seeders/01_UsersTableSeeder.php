<?php
class UsersTableSeeder extends CI_Model
{
    public function __construct($limit = 25)
    {
    }

    public function run($limit = 25)
    {
        $faker = Faker\Factory::create();

        $this->seedGroups();

        $this->db->truncate('users');
        $this->seedDefaultUsers();

        $photos = [];
        foreach (scandir(APPPATH.'../assets/uploads/users') as $file) {
            if(pathinfo($file, PATHINFO_EXTENSION) == 'jpg' || pathinfo($file, PATHINFO_EXTENSION) == 'png') {
                //delete
//                @unlink(APPPATH.'../assets/uploads/staff/'.$file);
                //reuse
                $photos[] = $file;
            }
        }

        for ($i = 1; $i <= $limit; $i++) {
            if ($i % 2 == 0) {
                $g = 'male';
            } else {
                $g = 'female';
            }

            $data = [
                'first_name' => $faker->firstName($g),
                'last_name' => $faker->lastName,
                'email' => $faker->email,
                'password' => password_hash('password', PASSWORD_BCRYPT),
                'pin' => rand(1111, 9999),
                'active' => 1,
                'photo' => count($photos) > 0 ? $photos[rand(0, count($photos)-1)] : '',
                'daycare_id' => $i + 5,
                'address_id' => $i + 5,
            ];
            $this->db->insert('users', $data);

            $id = $this->db->insert_id();

            $this->db->insert('users_groups', ['group_id' => rand(1, 4), 'user_id' => $id]);
        }
    }

    public function seedDefaultUsers()
    {
        $photos = [];
        foreach (scandir(APPPATH.'../assets/uploads/users') as $file) {
            if(pathinfo($file, PATHINFO_EXTENSION) == 'jpg' || pathinfo($file, PATHINFO_EXTENSION) == 'png') {
                //delete
//                @unlink(APPPATH.'../assets/uploads/staff/'.$file);
                //reuse
                $photos[] = $file;
            }
        }

        $users = [
            [
                'first_name' => 'Super',
                'last_name' => 'Super',
                'email' => 'super@app.com',
                'password' => password_hash('password', PASSWORD_DEFAULT),
                'active' => 1,
                'created_at' => date_stamp(),
                'pin' => rand(1111, 9999),
                'photo' => count($photos) > 0 ? $photos[rand(0, count($photos)-1)] : '',
                'daycare_id' => 1,
                'address_id' => 1
            ],
            [
                'first_name' => 'Admin',
                'last_name' => 'Admin',
                'email' => 'admin@app.com',
                'password' => password_hash('password', PASSWORD_DEFAULT),
                'active' => 1,
                'created_at' => date_stamp(),
                'pin' => rand(1111, 9999),
                'photo' => count($photos) > 0 ? $photos[rand(0, count($photos)-1)] : '',
                'daycare_id' => 2,
                'address_id' => 2
            ],
            [
                'first_name' => 'Manager',
                'last_name' => 'Manager',
                'email' => 'manager@app.com',
                'password' => password_hash('password', PASSWORD_DEFAULT),
                'active' => 1,
                'created_at' => date_stamp(),
                'pin' => rand(1111, 9999),
                'photo' => count($photos) > 0 ? $photos[rand(0, count($photos)-1)] : '',
                'daycare_id' => 3,
                'address_id' => 3
            ],
            [
                'first_name' => 'Staff',
                'last_name' => 'Staff',
                'email' => 'staff@app.com',
                'password' => password_hash('password', PASSWORD_DEFAULT),
                'active' => 1,
                'created_at' => date_stamp(),
                'pin' => rand(1111, 9999),
                'photo' => count($photos) > 0 ? $photos[rand(0, count($photos)-1)] : '',
                'daycare_id' => 4,
                'address_id' => 4
            ],
            [
                'first_name' => 'Parent',
                'last_name' => 'Parent',
                'email' => 'parent@app.com',
                'password' => password_hash('password', PASSWORD_DEFAULT),
                'active' => 1,
                'created_at' => date_stamp(),
                'pin' => rand(1111, 9999),
                'photo' => count($photos) > 0 ? $photos[rand(0, count($photos)-1)] : '',
                'daycare_id' => 5,
                'address_id' => 5
            ],
        ];
        foreach ($users as $user) {
            $this->db->insert('users', $user);
            $id = $this->db->insert_id();
            $data = [
                'group_id' => 1,
                'user_id' => $id,
            ];
            $query = $this->db->insert('users_groups', $data);
            if (!$query) {
                show_error('Unable to seed');
            }
        }
    }

    public function seedGroups()
    {
        $this->db->truncate('users_groups');
        $this->db->truncate('groups');

        $groups = [
            'admin', 'manager', 'staff', 'parent'
        ];
        foreach ($groups as $group) {
            $this->db->insert('groups', ['name' => $group]);
        }
    }
}
