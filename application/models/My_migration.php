<?php if(!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class My_migration extends CI_Model
{

    function __construct()
    {
        $this->seedDir = APPPATH.'database/seeders/';
    }

    /**
     * Seeder for one class
     *
     * Seeds for one class in application/da
     *
     **/
    public function seedOne($class = NULL)
    {
        if($class == NULL) {
            show_error('No seeder classname entered');
        }

        $path = '';
        foreach (scandir($this->seedDir) as $file) {
            if($file == "." || $file == "..") continue;

            $name = $this->_get_seeder_name($file);

            if($name == $class) {
                $path = $this->seedDir.DIRECTORY_SEPARATOR.$file;
                break;
            }

        }

        if(is_file($path)) {
            require_once $path;
            $this->_do_seed($class);
        } else {
            show_error('Seeder file not found');
        }

        echo 'Completed seeding '.$class.PHP_EOL;
    }

    public function seedAll()
    {
        echo 'Seeding tables. Please wait...'.PHP_EOL;

        $count = 0;

        foreach (scandir($this->seedDir) as $name) {
            if($name == '.' || $name == '..'){
                continue;
            }

            require_once $this->seedDir.'/'.$name;

            $class = $this->_get_seeder_name($name);

            $this->_do_seed($class);

            $count++;
        }
        echo 'Completed seeding '.$count.' tables '.PHP_EOL;
    }

    public function refresh()
    {
        if(ENVIRONMENT !== 'production') {
            echo 'CAUTION! You are in production mode!';
        }

        echo "Are you sure you want to do this?  Type 'yes' to continue: ";

        $handle = fopen('php://stdin', 'r');
        $line = fgets($handle);
        if(trim($line) != 'yes') {
            echo "ABORTING!\n";
            exit;
        }
        fclose($handle);
        echo "\n";
        echo "Thank you, reloading migrations...\n";

        $tables = $this->db->list_tables();

        foreach ($tables as $table) {
            $this->db->query('SET FOREIGN_KEY_CHECKS=0;');

            if($table == 'migrations') {
                $this->db->query('TRUNCATE table migrations');
                $this->db->insert('migrations', ['version' => 0]);
                continue;
            }
            echo "Migrating {$table}\t....................";
            $this->dbforge->drop_table($table, TRUE);
            echo "Done!\n";

            $this->db->query('SET FOREIGN_KEY_CHECKS=1;');
        }
        echo "All tables have been dropped!\nLoading new tables\t....................";

        $this->migration->latest();

        echo "Done!\n";

        echo "Seeding\t....................";
        $this->seed();
        echo 'Done!';
    }

    protected function _get_seeder_name($name)
    {
        $name = sscanf($name, '%d %s');
        $name = str_replace('_', '', $name[1]);
//        $name = basename($name, '.php');
        return $name;
    }

    protected function _do_seed($class)
    {
        echo 'Seeding '.$class.PHP_EOL;

        $this->db->query('SET FOREIGN_KEY_CHECKS=0;');

        $class = basename($class,'.php');

        $cn = new $class;

        $cn->run();

        $this->db->query('SET FOREIGN_KEY_CHECKS=1;');
    }

    public function help()
    {
        echo "php index.php migration migrate <version> \tMigrate tables into the database up to version specified".PHP_EOL;
        echo "php index.php migration create \tGenerate migrations for all tables".PHP_EOL;
        echo "php index.php migration create <table_name> \tGenerate migration for one table".PHP_EOL;
        echo "php index.php migration seed \t Seed all seeder files located in /application/database/seeders".PHP_EOL;
        echo "php index.php migration seed <ClassName> \t Seed only specific database seeder".PHP_EOL;
//        echo "php index.php migrate create [table1, table2] \tGenerate migration for an array of tables".PHP_EOL;
        //        echo "php index.php migrate create 'table1, table2' \tGenerate migration for a list of tables".PHP_EOL;
        echo "php index.php migration version <version number> \tPerform migration for a specific version".PHP_EOL;
        echo "php index.php refresh \tReload all tables. All data will be lost".PHP_EOL;
    }
}
