<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_backup_csv extends CI_Migration
{

    /**
     * up (create table)
     *
     * @return void
     */
    public function up()
    {

        // Add Fields.
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => '11',
            ),
            'backup_path' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
            ),
            'backup_date' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
            ),
        ));

        // Add Primary Key.
        $this->dbforge->add_key("id", TRUE);

        // Table attributes.

        $attributes = array(
            'ENGINE' => 'InnoDB',
        );

        // Create Table backup_csv
        $this->dbforge->create_table("backup_csv", TRUE, $attributes);

    }

    /**
     * down (drop table)
     *
     * @return void
     */
    public function down()
    {
        // Drop table backup_csv
        $this->dbforge->drop_table("backup_csv", TRUE);
    }

}
