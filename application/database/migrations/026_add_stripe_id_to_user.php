<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_stripe_id_to_user extends CI_Migration
{

    /**
     * up (create table)
     *
     * @return void
     */
    protected $table = 'user';

    public function up()
    {
       //nothing here
        //moved to migration 044
    }

    /**
     * down (drop table)
     *
     * @return void
     */
    public function down()
    {
       //nothing here
    }

}
