<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class: my_news
 * User: John Muchiri
 * Email: jgmuchiri@gmail.com
 * Date: 11/17/2014
 *
 * https://amdtllc.com
 * Copyright 2014 All Rights Reserved
 */
class My_news extends CI_Model
{
    function count($status=''){
        if($status !=='')
            $this->db->where('status',$status);
        return $this->db->count_all('news');
    }

    function articles($opts=array())
    {
        if(!empty($opts)){
            foreach($opts as $opt=>$val){
                if(is_array($val))
                    $this->db->$opt($val[0],$val[1]);
                else
                    $this->db->$opt($val);
            }
        }
        $this->db->order_by('created_at','DESC');
        $articles = $this->db->get('news')->result();

        return $articles;
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    function article($id)
    {
//        $article= $this->db->where('id', $id)->get('news')->row();
//        $user= $this->db->where('id',$article->user_id)->get('users')->row();
//        $article->user = $user;
//        $article->category=$this->db->where('id',$article->category_id)->get('news_categories')->row();

        $article = $this->db
            ->select('n.*,u.first_name,u.last_name,u.email,nc.name as category_name')
            ->where('n.id',$id)
            ->from('news as n')
            ->join('users as u','u.id=n.user_id')
            ->join('news_categories as nc','nc.id=n.category_id')
            ->get()->row();
        return $article;
    }

    protected function _fillable($id = NULL)
    {
        if($this->input->post('category')) {
            $categories=$this->db->where('id', $this->input->post('category_id'))->get('news_categories');
            if($categories->num_rows() == 0) {
                $this->db->insert('news_categories', ['name' => $this->input->post('category')]);
                $category = $this->db->insert_id();
            }
        } else {
            $category = $this->input->post('category_id');
        }

        $data['title'] = $this->input->post('title');
        $data['content'] = $this->input->post('content');
        $data['list_order'] = $this->input->post('list_order');
        $data['status'] = $this->input->post('status');
        $data['category_id'] = $category;

        if($id == NULL) {
            $data['user_id'] = $this->user->uid();
        }

        $data['publish_date'] = $this->input->post('publish_date') || date_stamp();

        return $data;

    }

    function create()
    {

        if($this->db->insert('news', $this->_fillable()))
            return TRUE;
        return FALSE;
    }

    function update($id)
    {
        $this->db->where('id', $id);
        if($this->db->update('news', $this->_fillable($id)))
            return TRUE;
        return FALSE;
    }

    function delete($id)
    {
        $this->db->where('id', $id);
        if($this->db->delete('news'))
            return TRUE;
        return FALSE;
    }

    function categories(){
        $categories= $this->db->get('news_categories')->result();
        $data=array();
        foreach($categories as $cat){
            $data[$cat->id]=$cat->name;
        }
        return $data;
    }

}