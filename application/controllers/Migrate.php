<?php defined("BASEPATH") or exit("No direct script access allowed");

class Migrate extends CI_Controller
{

    public function index($version)
    {
        $this->load->library("migration");

        if (!$this->migration->version($version)) {
            show_error($this->migration->error_string());
        }
    }

    public function version($version)
    {
        if ($this->input->is_cli_request()) {
            $migration = $this->migration->version($version);
            if (!$migration) {
                echo $this->migration->error_string();
            } else {
                echo 'Migration(s) done' . PHP_EOL;
            }
        } else {
            show_error('You don\'t have permission for this action');;
        }
    }
    function test()
    {
        $this->load->model('Migration_lib', 'mig');
        //$this->mig->generate();
    }
}