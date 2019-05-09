<?php

class My_daycare_registration extends CI_Model
{   
    public function store()
    {
        $daycare_id = $this->generate_unquie_daycareId();

        $query = $this->db->get_where('daycare', array(
            'daycare_id' => $daycare_id
        ));
        $count = $query->num_rows();
        if ($count !== 0) {
            $daycare_id = $this->generate_unquie_daycareId();
        }
        $data = array(
            'name' => $this->input->post('name'),
            'employee_tax_identifier' => $this->input->post('employee_tax_identifier'),
            'address_line_1' => $this->input->post('address_line_1'),
            'address_line_2' => $this->input->post('address_line_2'),
            'city' => $this->input->post('city'),
            'state' => $this->input->post('state'),
            'zip' => $this->input->post('zip_code'),
            'country' => $this->input->post('country'),
            'phone' => $this->input->post('phone'),
            'daycare_id' => $daycare_id
        );
        $this->db->insert('daycare', $data);

        $insert_id = $this->db->insert_id();

        $email = $this->session->userdata('email');
        $data = array(
            'daycare_id' => $insert_id,
        );
        $this->db->where('email', $email);
        $this->db->update('users', $data);
    }
    public function generate_unquie_daycareId(){
        $year = date("y");
        $month = date("m");
        $pin = mt_rand(1000, 9999);
        $daycare_id = $year . "-" . $month . "-" .$pin;

        return $daycare_id;
    }
}
