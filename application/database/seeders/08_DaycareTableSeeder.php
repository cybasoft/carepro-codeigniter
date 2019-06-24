<?php

class DaycareTableSeeder extends CI_Model
{

    public function __construct($limit = 30)
    {
    }

    public function run($limit = 30)
    {

        $faker = Faker\Factory::create();

        echo 'Cleaning up...'.PHP_EOL;

        $this->db->truncate('daycare');
        $this->db->truncate('address');

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
            $address_data = [
                'address_line_1' => $faker->streetAddress,
                'address_line_2' => $faker->streetName,                
                'phone' => $faker->phoneNumber,
                'city' => $faker->city,
                'state' => $faker->state,
                'zip_code' => $faker->postcode,
                'country' => $faker->country               
            ];
            $this->db->insert('address',$address_data);
            $address_id = $this->db->insert_id();

            $year = date("y");
            $month = date("m");
            $pin = mt_rand(1000, 9999);
            $daycare_id = $year . "-" . $month . "-" .$pin;

            $data = [
                'name' => $faker->company,
                'employee_tax_identifier' => $faker->firstName,                
                'daycare_id' => $daycare_id,
                'logo' => '',
                'address_id' => $address_id          
            ];

            $this->db->insert('daycare', $data);            
        }
    }
}
