<?php defined('BASEPATH') or exit('No direct script access allowed');

class MessagingController extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        setRedirect();
        auth(true);
        $this->title=lang('Messages');
    }

    function index()
    {

        $senders=$this->getSenders();

        $chat = [];
        if(isset($_GET['m'])) {
           $chat= $this->getMessages($_GET['m']);
        }

        page('messaging/messaging_index', compact('senders', 'chat'));
    }

    function getMessages($sender){
        $received = $this->db
            ->select('c.*,CONCAT(u.first_name, " ", u.last_name) AS name,u.id AS user_id,u.photo,u.email')
            ->where('c.receiver_id', user_id())
            ->where('c.sender_id',$sender)
            ->from('chat AS c')
            ->join('users AS u', 'u.id=c.sender_id')
            ->get()->result();
        $response =  $this->db
            ->select('c.*,CONCAT(u.first_name, " ", u.last_name) AS name,u.id AS user_id,u.photo,u.email')
            ->where('c.receiver_id', $sender)
            ->where('c.sender_id', user_id())
            ->from('chat AS c')
            ->join('users AS u', 'u.id=c.sender_id')
            ->get()->result();

        $chat = array_merge($received,$response);
        usort($chat, function($a,$b) {
            return $a->created_at <=> $b->created_at;
        });
        return $chat;
    }

    function getSenders(){
        return $this->db
            ->select('u.id,u.email,CONCAT(u.first_name, " ", u.last_name) AS name,u.photo')
            ->where('c.receiver_id', user_id())
            ->from('chat AS c')
            ->join('users AS u', 'u.id=c.sender_id', 'left')
            ->get()->result();
    }

    function send(){
        $this->form_validation->set_rules('message', lang('Message'),'required|trim|xss_clean' );
        if($this->form_validation->run() == TRUE) {
            $this->db->insert('chat',[
               'message_key'=>time().rand(000000,999999),
                'sender_id'=>user_id(),
                'receiver_id'=> $this->input->post('receiver_id'),
                'message'=> $this->input->post('message'),
                'is_read'=>0,
                'created_at'=>date_stamp()
            ]);
            flash('success',lang('Message sent'));
        } else {
            validation_errors();
            flash('error');
        }
        redirectPrev();
    }
}