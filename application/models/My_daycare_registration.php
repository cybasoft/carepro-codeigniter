<?php

class My_daycare_registration extends CI_Model
{   
    public function store()
    {
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
        );
        $this->db->insert('daycare', $data);
    }
}
