<?php defined("BASEPATH") or exit("No direct script access allowed");

class Migration extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->library("migration");

        //prevent direct access
        if (!$this->input->is_cli_request()) {
            show_error("CLI only! Direct calls denied.");
        }

        //prevent migrations in production mode
        if (ENVIRONMENT == 'production') {
            show_error('Set application environment to development first');
        }
    }

    function help()
    {
        echo "php index.php migration migrate <version> \tMigrate tables into the database up to version specified" . PHP_EOL;
        echo "php index.php migration create \tGenerate migrations for all tables" . PHP_EOL;
        echo "php index.php migration create <table_name> \tGenerate migration for one table" . PHP_EOL;
//        echo "php index.php migrate create [table1, table2] \tGenerate migration for an array of tables".PHP_EOL;
//        echo "php index.php migrate create 'table1, table2' \tGenerate migration for a list of tables".PHP_EOL;
        echo "php index.php migration version <version number> \tPerform migration for a specific version" . PHP_EOL;
    }

    public function migrate($version)
    {

        $migration = $this->migration->version($version);;
        if (!$migration) {
            show_error($this->migration->error_string());
        } else {
            echo 'Migration(s) done' . PHP_EOL;
        }
    }

    function create($tables = "*")
    {
        $this->load->library('Migrations');
        echo "Generating migration files for " . $tables . " " . PHP_EOL;
        $this->migrations->generate($tables);

    }

    function seed($table = "*")
    {
        echo 'Seeding table(s) '.$table.' ' . PHP_EOL;
        switch($table){
            case "*":
                $this->seedGroups();
                $this->seedUsers();
                break;
            case "users":
                $this->seedUsers();
                break;
            case "groups":
                $this->seedGroups();
                break;
            default:
                show_error("Unable to perform action requested");
                break;
        }
        echo "Seeding completed " . PHP_EOL;
    }

    function seedUsers()
    {
        $users[] = array(
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'email' => 'admin@app.com',
            'password' => password_hash('password', PASSWORD_DEFAULT),
            'active' => 1,
            'created_at' => date_stamp(),
            'pin'=>rand(1111,9999)
        );
        foreach ($users as $user) {
            $this->db->insert('users', $user);
            $id = $this->db->insert_id();
            $data = array(
                'group_id'=>1,
                'user_id'=>$id
            );
            $query=$this->db->insert('users_groups',$data);
            if(!$query)
                show_error('Unable to seed');
        }
    }

    function seedGroups()
    {
        $groups = array(
            'admin', 'manager', 'staff', 'parent'
        );
        foreach ($groups as $group) {
            $this->db->insert('groups', array('name' => $group));
        }
    }
}