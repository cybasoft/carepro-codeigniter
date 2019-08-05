<?php

class DaycareTableSeeder extends CI_Model
{

    public function __construct($limit = 2)
    {
    }

    public function run($limit = 2)
    {

        $faker = Faker\Factory::create();

        echo 'Cleaning up...'.PHP_EOL;

        $this->db->truncate('daycare');
        $this->db->truncate('address');
        $this->db->truncate('daycare_settings');
        
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

            if($i == 1){
                $name = "Daycarepro";
            }else{
                $name = "Careproapp";
            }
            $data = [
                'name' => $name,
                'employee_tax_identifier' => '12345',                
                'daycare_id' => $daycare_id,
                'logo' => '',
                'address_id' => $address_id          
            ];

            $this->db->insert('daycare', $data);
            $insert_id = $this->db->insert_id();

            $setting_data = [
                'daycare_id' => $insert_id,              
            ];
            $this->db->insert('daycare_settings',$setting_data);

        }
    }
}
