<?php defined("BASEPATH") or exit("No direct script access allowed");

class Migrate extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if (!$this->input->is_cli_request()) {
            die("CLI only! Direct calls denied.");
        }
    }

    public function index($version)
    {
        $this->load->library("migration");

        if (!$this->migration->version($version)) {
            show_error($this->migration->error_string());
        }
    }

    function help()
    {
        echo "php index.php migrate create \tGenerate migrations for all tables" . PHP_EOL;
        echo "php index.php migrate create <table_name> \tGenerate migration for one table" . PHP_EOL;
//        echo "php index.php migrate create [table1, table2] \tGenerate migration for an array of tables".PHP_EOL;
//        echo "php index.php migrate create 'table1, table2' \tGenerate migration for a list of tables".PHP_EOL;
        echo "php index.php migrate version <version number> \tPerform migration for a specific version" . PHP_EOL;
    }

    public function version($version)
    {
        if ($this->input->is_cli_request()) {
            $migration = $this->migration->version($version);;
            if (!$migration) {
                echo $this->migration->error_string();
            } else {
                echo 'Migration(s) done' . PHP_EOL;
            }
        } else {
            show_error('You don\'t have permission for this action');;
        }
    }

    function create($tables = "*")
    {
        $this->load->library('Migrations');
        echo "Generating migration files for " . $tables . " " . PHP_EOL;
       $this->migrations->generate($tables);

    }

    function migrate($version){
        $this->load->library("migration");

        if (!$this->migration->version($version)) {
            show_error($this->migration->error_string());
        }
    }

    function seed($table="*")
    {
        echo "Seeding tables " . PHP_EOL;
        $this->seedGroups();
        $this->seedUsers();
        echo "Seeding completed " . PHP_EOL;
    }

    function seedUsers(){
        function users(){
            $users = array(
                'first_name'=>'Admin',
                'last_name'=>'Admin',
                'email'=>'admin@app.com',
                'password'=>password_hash('password',PASSWORD_DEFAULT),
                'active'=>1,
                'created_at'=>date_stamp()
            );
            foreach ($users as $user){
                $this->db->insert('users',$user);
            }
        }
    }
    function seedGroups(){
        $groups = array(
            'admin','manager','staff','parent'
        );
        foreach ($groups as $group){
            $this->db->insert('groups',array('name'=>$group));
        }
    }
}