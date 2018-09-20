<?php defined('BASEPATH') or exit('No direct script access allowed');

class Migration extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('migration');
        $this->load->model('My_migration', 'mig');

        //prevent direct access
        if (!is_cli()) {
            show_error('CLI only! Direct calls denied.');
        }
    }

    public function help()
    {
        $this->mig->help();
    }

    public function run($version = null)
    {
        //prevent migrations in production mode
        if (ENVIRONMENT == 'production' && $this->uri->segment(3) !== 'force') {
            show_error("\nSet application config to development mode first \n or use \n'php index.php migration run force'");
        }

        if (ENVIRONMENT == 'production' && $version == null) {
            show_error("\nIn production mode, you must  enter version number");
        }

        $mig = $this->db->get('migrations')->row();
        $migration = false;

        if (count((array) $mig) > 0) {
            if ($version == null) { //migrate all
                $migration = $this->migration->latest();
            } else {
                if ($version == $mig->version) { //same migration run twice
                    echo lang('This migration has already been run') . PHP_EOL;
                    exit();
                }
                if ($version < $mig->version) { //rollback
                    echo sprintf(lang('Rolling back from migration %s to %s'), $mig->version, $version) . PHP_EOL;
                }
                $files = glob(APPPATH . 'database/migrations/' . $version . '*.php');
                //check if migration files exist exist
                if (count($files) > 0) {
                    $migration = $this->migration->version($version);
                } else {
                    echo lang('No new migrations to run') . PHP_EOL;
                    exit();
                }
            }
        }
        if (!$migration) {
            show_error($this->migration->error_string());
        } else {
            echo lang('Migration(s) done') . PHP_EOL;
        }
    }

    /**
     * Generate migration file for a table
     */
    public function create($tables = '*')
    {
        $this->load->library('Migrations');
        echo 'Generating migration files for ' . $tables . ' ' . PHP_EOL;
        $this->migrations->generate($tables);
    }

    /**
     * Seed default data
     */
    public function seed($class = '*')
    {
        if ($class == '*') {
            $this->mig->seedAll();
        } else {
            $this->mig->seedOne($class);
        }

        echo 'Seeding completed ' . PHP_EOL;
    }

    /**
     * Clean up all migrations and reload
     */
    public function refresh()
    {
        $this->mig->refresh();
    }
}
