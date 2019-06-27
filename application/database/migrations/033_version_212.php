<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_version_212 extends CI_Migration
{
    /**
     * up (create table)
     *
     * @return void
     */

    public function up()
    {
        @rename(APPPATH.'../assets/uploads/users/children/', APPPATH.'../assets/uploads/children/');
        @rename(APPPATH.'../assets/uploads/users/staff/', APPPATH.'../assets/uploads/users/');
        @rename(APPPATH.'../assets/uploads/users/pickup/', APPPATH.'../assets/uploads/pickup/');
        @rmdir(APPPATH.'../assets/uploads/users/parents/');

        //options
        $this->dbforge->add_field(
            [
                'id' => [
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ],
                'option_name' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 191,
                    'unique' => true,
                    'null' => false
                ),
                'option_value' => array(
                    'type' => 'LONGTEXT',
                    'null' => true
                ),
                'autoload' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 20,
                    'null' => true
                )
            ]
        );
        $this->dbforge->add_key("id", TRUE);
        $this->dbforge->create_table('options', TRUE);

        foreach (special_options() as $option=>$value) {
            $this->db->insert('options', ['option_name' => $option, 'option_value' =>$value]);
        }
        //add dates to child problems
        $this->db->query('ALTER TABLE child_problems ADD first_event DATE NULL;');
        $this->db->query('ALTER TABLE child_problems ADD last_event DATE NULL;');
    }

    /**
     * down (drop table)
     *
     * @return void
     */
    public function down()
    {
        @rename(APPPATH.'../assets/uploads/children/', APPPATH.'../assets/uploads/users/children/');
        @rename(APPPATH.'../assets/uploads/users/', APPPATH.'../assets/uploads/users/staff/');
        @rename(APPPATH.'../assets/uploads/pickup/', APPPATH.'../assets/uploads/users/pickup/');

        $this->dbforge->drop_table('options', TRUE);

        $this->dbforge->drop_column('child_problems', 'first_event');
        $this->dbforge->drop_column('child_problems', 'last_event');
    }

}