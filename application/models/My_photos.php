<?php
/**
 * @package     daycarepro
 * @copyright   2018 A&M Digital Technologies
 * @author      John Muchiri
 * @link        https://amdtllc.com
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

class My_photos extends CI_Model
{

    function albums($table, $child_id = null, $category = null,$base_url=null)
    {
        if($base_url==null)
            base_url('child/'.$child_id.'/photos');

        $data = array();
        $data['results'] = array();
        $limit_per_page = 50;
        $start_index = (isset($_GET['per_page']) && $_GET['per_page']>0) ? $_GET['per_page'] : 0;
        if($child_id == null) {
            $total_records = $this->db->count_all($table);
        } else {
            $total_records = $this->db->where('child_id', $child_id)->count_all($table);
        }
        if($total_records>0) {
            $this->db->limit($limit_per_page, $start_index);
            if($category !== null)
                $this->db->where('category', $category);
            if($child_id !== null)
                $this->db->where('child_id', $child_id);
            $query = $this->db->get($table);
            if($query->num_rows()>0) {
                foreach ($query->result() as $row) {
                    $photos[] = $row;
                }
                $data["results"] = $photos;
            }
            $data["links"] = $this->pagination($total_records, $limit_per_page, $base_url);
        }
        return $data;
    }

    /**
     * @param $total_records
     * @param $limit_per_page
     * @param $base_url
     * @return mixed
     */
    function pagination($total_records, $limit_per_page, $base_url)
    {
        $this->load->library('pagination');
        $config['base_url'] = $base_url;
        $config['enable_query_strings'] = true;
        $config['page_query_string'] = true;
        $config['total_rows'] = $total_records;
        $config['per_page'] = $limit_per_page;
        $config['use_page_numbers'] = TRUE;
        $config['num_links'] = 4;
        $config['full_tag_open'] = "<ul class='pagination'>";
        $config['full_tag_close'] = "</ul>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = "<li>";
        $config['next_tagl_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";
        $this->pagination->initialize($config);
        return $this->pagination->create_links();
    }

    /**
     * @param $childID
     * @return string
     */
    function store($childID, $category = 'album')
    {
        $upload_path = './assets/uploads/photos';
        if(!file_exists($upload_path)) {
            mkdir($upload_path, 755, true);
        }
        $config = array(
            'upload_path' => $upload_path,
            'allowed_types' => 'gif|jpg|png|jpeg',
            'max_size' => '3048',
            'encrypt_name' => true,
        );
        $this->load->library('upload', $config);
        if(!$this->upload->do_upload('file')) {
            $msg = lang('request_error');
            $type = 'error';
        } else {
            $upload_data = $this->upload->data();
            $this->db->insert('photos', [
                'name' => $upload_data['file_name'],
                'child_id' => $childID,
                'uploaded_by' => $this->user->uid(),
                'caption' => '',
                'category' => $category,
                'created_at' => date_stamp()
            ]);
            if($upload_data) {
                $msg = lang('request_success');
                $type = 'success';
            } else {
                $msg = lang('request_error');
                $type = 'error';
            }
        }
        return json_encode($msg, $type);
    }

    /**
     * @param $childID
     * @return string
     */
    function storeIncidentPhotos($childID)
    {
        $table = 'child_incident_photos';
        $upload_path = './assets/uploads/photos';
        if(!file_exists($upload_path)) {
            mkdir($upload_path, 755, true);
        }
        $config = array(
            'upload_path' => $upload_path,
            'allowed_types' => 'gif|jpg|png|jpeg',
            'max_size' => '3048',
            'encrypt_name' => true,
        );
        $this->load->library('upload', $config);
        if(!$this->upload->do_upload('file')) {
            $msg = lang('request_error');
            $type = 'error';
        } else {
            $upload_data = $this->upload->data();
            $this->db->insert($table, [
                'incident_id' => $this->input->post('incident_id'),
                'photo' => $upload_data['file_name'],
                'child_id' => $childID,
                'user_id' => $this->user->uid(),
                'created_at' => date_stamp()
            ]);
            if($upload_data) {
                $msg = lang('request_success');
                $type = 'success';
            } else {
                $msg = lang('request_error');
                $type = 'error';
            }
        }
        return json_encode($msg, $type);
    }
}