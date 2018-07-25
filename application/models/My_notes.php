<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @package     daycarepro app
 * @copyright   2018 A&M Digital Technologies
 * @author      John Muchiri
 * @link        https://amdtllc.com
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */
class My_notes extends CI_Model
{

    /**
     * @return bool
     */
    function store()
    {
        $child_id = $this->input->post('child_id');
       
        $data = array(
            'child_id' => $child_id,
            'title' => $this->input->post('title'),
            'content' => htmlspecialchars($this->input->post('note-content')),
            'category_id'=> $this->input->post('category_id'),
            'tags'=>implode(',', $this->input->post('tags')),
            'user_id' => $this->user->uid(),
            'created_at' => date_stamp()
        );

        $this->db->insert('child_notes', $data);

        if($this->db->affected_rows() > 0) {
            //log event
            logEvent("Added note for child ID: {$child_id}");
            //notify parents
            $this->parent->notifyParents($child_id, lang('note_created_email_subject'), sprintf(lang('note_created_email_message'), $this->child->first($child_id)->first_name));
            return true;
        }
        return false;
    }

    /**
     * @return bool
     */
    function destroy()
    {
        $this->db->where('id', $this->uri->segment(3));
        $this->db->delete('child_notes');
        if($this->db->affected_rows() > 0)
            return true;
        return false;
    }

    /**
     * @param $id
     *
     * @return string
     */
    function category($id){
        $cat = $this->db->where('id',$id)->get('notes_categories')->row();
        if(count((array)$cat)>0)
            return $cat->name;
        return '';
    }

    /**
     * @param $child_id
     *
     * @return bool
     */
    function createIncident()
    {
        $child_id = $this->input->post('child_id');
        $date_occurred = $this->input->post('date').' '.$this->input->post('time');
        $data = array(
            'child_id' => $child_id,
            'title' => $this->input->post('title'),
            'location' => $this->input->post('location'),
            'incident_type' => $this->input->post('incident_type'),
            'description' => $this->input->post('description'),
            'actions_taken' => $this->input->post('actions_taken'),
            'witnesses' => $this->input->post('witnesses'),
            'remarks' => $this->input->post('remarks'),
            'date_occurred' => $date_occurred,
            'user_id' => $this->user->uid(),
            'created_at' => date_stamp()
        );
        $this->db->insert('child_incident', $data);
        if($this->db->affected_rows() > 0) {

            logEvent("Added incident report for child ID: {$child_id}");
            $this->parent->notifyParents($child_id, lang('incident_email_subject'), sprintf(lang('incident_email_message'), $this->child->get($child_id, 'name')));
            return $this->db->insert_id();
        }
        return false;
    }

    function getNote(){
        $noteId= $this->input->post('note_id');
        $note = $this->db->where('id', $noteId)->get('child_notes')->row();
        $data = [
            'title'=>$note->title,
            'content'=>htmlspecialchars_decode($note->content),
            'user'=>$this->user->get($note->user_id,'name'),
            'created_at'=>format_date($note->created_at),
            'category'=>$this->notes->category($note->category_id),
            'tags'=>$this->getTags($note->tags)
        ];

        return $data;
    }

    /**
     * @param $tags
     *
     * @return string
     */
    function getTags($tags){
        $tags = explode(',',$tags);

        $str = '';
        foreach($tags as $tag){
            $str .='<span class="label label-default">'.$tag.'</span>';
        }
        return $str;
    }

    /**
     * @param $id
     *
     * @return bool
     */
    function deleteIncident($id)
    {

        //delete photos
        $photos = $this->db->where('incident_id', $id)->get('child_incident_photos');
        if($photos->num_rows() > 0) {

            foreach ($photos->result() as $photo) {
                @unlink('./assets/uploads/photos/'.$photo->photo);
            }
            $this->db->where('incident_id', $id)->delete('child_incident_photos');

        }
        $this->db->where('id', $id);
        $this->db->delete('child_incident');
        if($this->db->affected_rows() > 0)
            return true;
        return false;

    }

    function destroyIncidentPhotos()
    {
        $photo = $this->db->where('id', $this->input->post('id'))->get('child_incident_photos')->row();
        @unlink('./assets/uploads/photos/'.$photo->photo);
        if($this->db->where('id', $this->input->post('id'))->delete('child_incident_photos'))
            return true;
        return false;
    }
}

?>