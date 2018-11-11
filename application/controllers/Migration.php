<?php defined('BASEPATH') or exit('No direct script access allowed');

class Migration extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        //correct previous migration issues
        $this->_fixes();

        $this->load->library('migration');
        $this->load->model('My_migration', 'mig');

        //prevent direct access
        if(!is_cli()) {
            show_error('CLI only! Direct calls denied.');
        }
    }

    public function help()
    {
        $this->mig->help();
    }

    public function run($version = NULL)
    {
        //warn migrations in production mode
        if(ENVIRONMENT == 'production') {
            echo 'CAUTION! You are in production mode!';
            echo "Are you sure you want to do this?  Type 'yes' to continue: ";

            $handle = fopen('php://stdin', 'r');
            $line = fgets($handle);
            if(trim($line) != 'yes') {
                echo "ABORTING!\n";
                exit;
            }
            fclose($handle);
        }

        $mig = $this->db->get('migrations')->row();
        $migration = FALSE;

        if(count((array)$mig) > 0) {
            if($version == NULL) { //migrate all
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
    function undo(){
        $mig = $this->db->get('migrations')->row();
        $newMig = $mig->version-1;

        //append 0 if 2 digit
        if(strlen($newMig)==2){
            $newMig = '0'.$newMig;
        }
        $this->run($newMig);
    }

    /**
     * Generate migration file for a table
     */
    public function create($tables = '*')
    {
        $this->load->library('Migrations');
        echo 'Generating migration files for '.$tables.' '.PHP_EOL;
        $this->migrations->generate($tables);
    }

    /**
     * Seed default data
     */
    public function seed($class = '*')
    {
        if($class == '*') {
            $this->mig->seedAll();
        } else {
            $this->mig->seedOne($class);
        }

        echo 'Seeding completed '.PHP_EOL;
    }

    /**
     * Clean up all migrations and reload
     */
    public function refresh()
    {
        $this->mig->refresh();
    }

    function _fixes(){
        //fixes
        @unlink(APPPATH.'/database/migrations/043_reate_activity_plan.php');
        @unlink(APPPATH.'database/migrations/044_add_stripe_id_to_user.php');

        $f = @fopen(APPPATH.'database/migrations/026_add_stripe_id_to_user.php', "r+");
        if ($f !== false) {
            ftruncate($f, 0);
            fclose($f);
        }
    }
}
