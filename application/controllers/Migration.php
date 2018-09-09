<?php defined("BASEPATH") or exit("No direct script access allowed");

class Migration extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library("migration");

        //prevent direct access
        if(!is_cli()) {
            show_error("CLI only! Direct calls denied.");
        }
    }

    function help()
    {
        echo "php index.php migration migrate <version> \tMigrate tables into the database up to version specified".PHP_EOL;
        echo "php index.php migration create \tGenerate migrations for all tables".PHP_EOL;
        echo "php index.php migration create <table_name> \tGenerate migration for one table".PHP_EOL;
//        echo "php index.php migrate create [table1, table2] \tGenerate migration for an array of tables".PHP_EOL;
//        echo "php index.php migrate create 'table1, table2' \tGenerate migration for a list of tables".PHP_EOL;
        echo "php index.php migration version <version number> \tPerform migration for a specific version".PHP_EOL;
        echo "php index.php refresh \tReload all tables. All data will be lost";
    }

    public function run($version = null)
    {
        //prevent migrations in production mode
        if(ENVIRONMENT == "production" && $this->uri->segment(3) !=="force")
            show_error("\nSet application config to development mode first \n or use \n'php index.php migration run force'");

        if(ENVIRONMENT =="production" && $version ==null)
            show_error("\nIn production mode, you must  enter version number");

        $mig = $this->db->get('migrations')->row();
        $migration = false;

        if(count((array)$mig) > 0) {
            if($version == null) {//migrate all
                $migration = $this->migration->latest();
            } else {
                if($version == $mig->version) { //same migration run twice
                    echo lang('This migration has already been run').PHP_EOL;
                    exit();
                }
                if($version < $mig->version) { //rollback
                    echo sprintf(lang('Rolling back from migration %s to %s'), $mig->version, $version).PHP_EOL;

                }
                $files = glob(APPPATH.'database/migrations/'.$version.'*.php');
                //check if migration files exist exist
                if(count($files) > 0) {
                    $migration = $this->migration->version($version);
                } else {
                    echo lang('No new migrations to run').PHP_EOL;
                    exit();
                }
            }
        }
        if(!$migration) {
            show_error($this->migration->error_string());
        } else {
            echo lang('Migration(s) done').PHP_EOL;
        }
    }

    /**
     * Generate migration file for a table
     */
    function create($tables = "*")
    {
        $this->load->library('Migrations');
        echo "Generating migration files for ".$tables." ".PHP_EOL;
        $this->migrations->generate($tables);

    }

    /**
     * Seed default data
     */
    function seed($table = "*")
    {
        echo 'Seeding table(s) '.$table.' '.PHP_EOL;
        switch ($table) {
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
                show_error(lang('request_error'));
                break;
        }
        echo "Seeding completed ".PHP_EOL;
    }

    /**
     * Clean up all migrations and reload
     */
    function refresh(){
        if(ENVIRONMENT=="development")
            show_error('You must be in development environment to run this command');

        echo "Are you sure you want to do this?  Type 'yes' to continue: ";

        $handle = fopen ("php://stdin","r");
        $line = fgets($handle);
        if(trim($line) != 'yes'){
            echo "ABORTING!\n";
            exit;
        }
        fclose($handle);
        echo "\n";
        echo "Thank you, reloading migrations...\n";

        $tables = $this->db->list_tables();

        foreach ($tables as $table)
        {
            $this->db->query('SET FOREIGN_KEY_CHECKS=0;');

            if($table =="migrations"){
                $this->db->query('TRUNCATE table migrations');
                $this->db->insert('migrations',['version'=>0]);
                continue;
            }
            echo "Migrating {$table}\t....................";
            $this->dbforge->drop_table($table,TRUE);
            echo "Done!\n";

            $this->db->query('SET FOREIGN_KEY_CHECKS=1;');
        }
        echo "All tables have been dropped!\nLoading new tables\t....................";

        $this->migration->latest();

        echo "Done!\n";

        echo "Seeding\t....................";
        $this->seed();
        echo "Done!";
    }
    function seedUsers()
    {
        $users = [
            [
                'first_name' => 'Super',
                'last_name' => 'Super',
                'email' => 'super@app.com',
                'password' => password_hash('password', PASSWORD_DEFAULT),
                'active' => 1,
                'created_at' => date_stamp(),
                'pin' => rand(1111, 9999)
            ],
            [
                'first_name' => 'Admin',
                'last_name' => 'Admin',
                'email' => 'admin@app.com',
                'password' => password_hash('password', PASSWORD_DEFAULT),
                'active' => 1,
                'created_at' => date_stamp(),
                'pin' => rand(1111, 9999)
            ],
            [
                'first_name' => 'Manager',
                'last_name' => 'Manager',
                'email' => 'manager@app.com',
                'password' => password_hash('password', PASSWORD_DEFAULT),
                'active' => 1,
                'created_at' => date_stamp(),
                'pin' => rand(1111, 9999)
            ],
            [
                'first_name' => 'Staff',
                'last_name' => 'Staff',
                'email' => 'staff@app.com',
                'password' => password_hash('password', PASSWORD_DEFAULT),
                'active' => 1,
                'created_at' => date_stamp(),
                'pin' => rand(1111, 9999)
            ],
            [
                'first_name' => 'Parent',
                'last_name' => 'Parent',
                'email' => 'parent@app.com',
                'password' => password_hash('password', PASSWORD_DEFAULT),
                'active' => 1,
                'created_at' => date_stamp(),
                'pin' => rand(1111, 9999)
            ]
        ];
        foreach ($users as $user) {
            $this->db->insert('users', $user);
            $id = $this->db->insert_id();
            $data = array(
                'group_id' => 1,
                'user_id' => $id
            );
            $query = $this->db->insert('users_groups', $data);
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