<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class My_migration extends CI_Model
{
    public $seedDir = APPPATH . 'database/seeders/';

    public function seedAll()
    {

        echo 'Seeding tables. Please wait...' . PHP_EOL;

        $count = 0;

        $files = [];

        foreach (scandir($this->seedDir) as $name) {
            if ($name != '.' && $name != '..') {

                require_once $this->seedDir . DIRECTORY_SEPARATOR . $name;

                $name = $this->_get_seeder_name($name);

                echo 'Seeding ' . $name . PHP_EOL;

                $this->db->query('SET FOREIGN_KEY_CHECKS=0;');

                $cn = new $name;

                $cn->run();

                $this->db->query('SET FOREIGN_KEY_CHECKS=1;');

                $count++;
            }
        }

        echo 'Completed seeding ' . $count . ' tables ';

    }

    public function refresh()
    {
        if (ENVIRONMENT !== "production") {
            echo 'CAUTION! You are in production mode!';
        }

        echo "Are you sure you want to do this?  Type 'yes' to continue: ";

        $handle = fopen("php://stdin", "r");
        $line = fgets($handle);
        if (trim($line) != 'yes') {
            echo "ABORTING!\n";
            exit;
        }
        fclose($handle);
        echo "\n";
        echo "Thank you, reloading migrations...\n";

        $tables = $this->db->list_tables();

        foreach ($tables as $table) {
            $this->db->query('SET FOREIGN_KEY_CHECKS=0;');

            if ($table == "migrations") {
                $this->db->query('TRUNCATE table migrations');
                $this->db->insert('migrations', ['version' => 0]);
                continue;
            }
            echo "Migrating {$table}\t....................";
            $this->dbforge->drop_table($table, true);
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

    protected function _get_seeder_name($name)
    {
        $name = sscanf($name, '%d %s');
        $name = str_replace('_', '', $name[1]);
        $name = basename($name, '.php');

        return $name;
    }
}
