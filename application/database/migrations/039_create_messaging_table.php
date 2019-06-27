<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_messaging_table extends CI_Migration
{

    /**
     * up (create table)
     *
     * @return void
     */
    public function up()
    {
        $this->db->query("UPDATE options SET option_value='name' WHERE option_name='company_name';");
        $this->dbforge->add_field(
            [
                'id' => [
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ],
                'message_key'=>[
                    'type'=>'INT',
                    'constraint'=>11,
                    'null'=>FALSE
                ],
                'sender_id' => [
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => TRUE,
                ],
                'receiver_id' => [
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => TRUE,
                ],
                'message'=>[
                    'type'=>'LONGTEXT',
                    'null'=>FALSE
                ],
                'file'=>[
                    'type'=>'VARCHAR',
                    'constraint'=>255,
                    'null'=>TRUE
                ],
                'is_read'=>[
                    'type'=>'TINYINT',
                    'null'=>FALSE
                ],
                'created_at' => [
                    'type' => 'DATETIME'
                ],
            ]);
        $this->dbforge->add_key("id", TRUE);
        $this->dbforge->create_table('chat', TRUE);
        $this->db->query('ALTER TABLE `chat` ADD FOREIGN KEY (`sender_id`) REFERENCES users(`id`) ON DELETE CASCADE');
        $this->db->query('ALTER TABLE `chat` ADD FOREIGN KEY (`receiver_id`) REFERENCES users(`id`) ON DELETE CASCADE');

    }

    /**
     * down (drop table)
     *
     * @return void
     */
    public function down()
    {
        // Drop table users
        $this->dbforge->drop_table("chat", TRUE);
    }

}
