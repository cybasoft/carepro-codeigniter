<?php defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Update_news_table extends CI_Migration
{

    /**
     * up (create table)
     *
     * @return void
     */
    public function up()
    {

        $this->dbforge->add_column('news',
            [
                'category_id'=>[
                    'type'=>'TINYINT',
                    'unsigned'=>true,
                    'null'=>true
                ],
                'status' => [
                    'type' => 'VARCHAR',
                    'constraint' => 50,
                ],
                'created_at'=>[
                    'type'=>'TIMESTAMP',
                    'null'=>TRUe
                ]
            ]);
        $this->db->query('ALTER TABLE news CHANGE article_name title varchar(255) NOT NULL;');
        $this->db->query('ALTER TABLE news CHANGE article_body content TEXT NOT NULL;');

        $this->dbforge->add_field(
            [
                'id' => [
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ],
                'name'=>[
                    'type'=>'VARCHAR',
                    'constraint'=>255,
                    'null'=>false,
                    'unique'=>true
                ],
                'description'=>[
                  'type'=>'VARCHAR',
                  'constraint'=>255,
                  'null'=>true
                ],
                'created_at' => [
                    'type' => 'DATETIME'
                ],
            ]);
        $this->dbforge->add_key("id", TRUE);
        $this->dbforge->create_table('news_categories', TRUE);
    }

    /**
     * down (drop table)
     *
     * @return void
     */
    public function down()
    {
        $this->db->query('ALTER TABLE news CHANGE  title article_name varchar(255) NOT NULL;');
        $this->db->query('ALTER TABLE news CHANGE content article_body TEXT NOT NULL;');
        $this->dbforge->drop_table('news_categories', TRUE);
    }

}
