<?php defined('BASEPATH') or exit('No direct script access allowed');

class MessagingController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        setRedirect();
        auth(true);
        $this->title = lang('Messages');
//        disable_debug();
    }

    public function index()
    {

        $senders = $this->getSenders();

        $chat = [];
        if (isset($_GET['m'])) {
            $chat = $this->getMessages($_GET['m']);
        }

        page('messaging/messaging_index', compact('senders', 'chat'));
    }

    public function getMessages($sender)
    {
        if ($sender !== user_id()) {
            $received = $this->db
                ->select('c.*,CONCAT(u.first_name, " ", u.last_name) AS name,u.id AS user_id,u.photo,u.email')
                ->where('c.receiver_id', user_id())
                ->where('c.sender_id', $sender)
                ->from('chat AS c')
                ->join('users AS u', 'u.id=c.sender_id')
                ->get()->result();
        } else {
            $received = array();
        }

        $response = $this->db
            ->select('c.*,CONCAT(u.first_name, " ", u.last_name) AS name,u.id AS user_id,u.photo,u.email')
            ->where('c.receiver_id', $sender)
            ->where('c.sender_id', user_id())
            ->from('chat AS c')
            ->join('users AS u', 'u.id=c.sender_id')
            ->get()->result();

        $chat = array_merge($received, $response);

        usort($chat, function ($a, $b) {
            return $a->created_at <=> $b->created_at;
        });
        
        return $chat;
    }

    public function getSenders()
    {
        return $this->db
            ->select('COUNT(*) as total, u.id,u.email,CONCAT(u.first_name, " ", u.last_name) AS name,u.photo')
            ->where('c.receiver_id', user_id())
            ->from('users AS u')
            ->join('chat AS c', 'u.id=c.sender_id')
            ->group_by('u.email')
            ->get()->result();
    }

    public function send()
    {
        $this->form_validation->set_rules('message', lang('Message'), 'required|trim|xss_clean');
        if ($this->form_validation->run() == true) {
            $this->db->insert('chat', [
                'message_key' => time() . rand(000000, 999999),
                'sender_id' => user_id(),
                'receiver_id' => $this->input->post('receiver_id'),
                'message' => $this->input->post('message'),
                'is_read' => 0,
                'created_at' => date_stamp(),
            ]);

            //notify user
            //todo send all chat transcript
            $message = sprintf(lang('You have a message from'), session('first_name') . ' ' . session('last_name'));
            $message .= '<br/><br/></hr>';
            $message .= '<strong>' . $this->input->post('message') . '</strong>';
            $message .= '<br/><br/><i>' . lang('Login to your account to respond or view full conversation') . '</i><br/>';
            $message .= anchor('/', site_url());
            $data = [
                'message' => $message,
                'to' => $this->user->get($this->input->post('receiver_id'), 'email'),
                'subject' => lang('New message from ' . session('company_name')),
                'salute' => $this->user->get($this->input->post('receiver_id'), 'first_name'),
            ];
            $this->mailer->send($data);
            flash('success', lang('Message sent'));
        } else {
            validation_errors();
            flash('error');
        }
        redirectPrev();
    }

    public function get_users()
    {

        $this->db->select('id,email,CONCAT(first_name," ",last_name) as name');
        $this->db->like('first_name', $this->input->post('user'));
        $this->db->or_like('last_name', $this->input->post('user'));
        $this->db->where('active', 1);
        $users = $this->db->get('users')->result_array();
        echo json_encode($users);
    }
}
