<?php defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->form_validation->set_error_delimiters(
            $this->config->item('error_start_delimiter', 'ion_auth'),
            $this->config->item('error_end_delimiter', 'ion_auth')
        );

        $this->lang->load('auth');
        $this->load->helper('language');
    }

    function index()
    {
        $this->login();
    }

    function login()
    {
        //validate form input
        $this->form_validation->set_rules('identity', 'Identity', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == true) {
            //check to see if the user is logging in
            //check for "remember me"
            $remember = (bool)$this->input->post('remember');

            if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember)) {
                //if the login is successful
                //redirect them back to the home page
                redirect('dashboard', 'refresh');
            } else {
                //if the login was un-successful
                //redirect them back to the login page
                flash('danger', 'Username or password is incorrect');

                redirect('login'); //use redirects instead of loading views for compatibility with MY_Controller libraries
            }
        } else {
            //the user is not logging in so display the login page
            $this->data['message'] = validation_errors();
            $this->data['identity'] = array(
                'name' => 'identity',
                'id' => 'identity',
                'type' => 'text',
                'value' => $this->form_validation->set_value('identity'),
                'class' => 'form-control',
                'placeholder' => 'Username/Email'
            );
            $this->data['password'] = array(
                'name' => 'password',
                'id' => 'password',
                'type' => 'password',
                'class' => 'form-control',
                'placeholder' => 'Password'
            );

            $this->page('login');
        }
    }

    /**
     * @param $username
     * @param $password
     * @param $email
     * @param array $additional_data
     * @param array $groups
     * @return bool
     */
    public function reg($username, $password, $email, $additional_data = array(), $groups = array())
    {

        $this->load->model('ion_auth_model');
        $this->ion_auth->trigger_events('pre_register');

        $manual_activation = $this->config->item('manual_activation', 'ion_auth');

        if ($this->ion_auth->email_check($email)) {
            $this->ion_auth->set_error('account_creation_duplicate_email');
            return FALSE;
        }

        // IP Address
        $ip_address = $this->input->ip_address();
        $password = $this->ion_auth->hash_password($password);

        // Users table.
        $data = array(
            'username' => $username,
            'password' => $password,
            'email' => $email,
            'ip_address' => $ip_address,
            'created_on' => time(),
            'last_login' => time(),
            'active' => ($manual_activation === false ? 1 : 0)
        );
 

        //filter out any data passed that doesnt have a matching column in the users table
        //and merge the set user data and the additional data
        $user_data = array_merge($this->ion_auth->_filter_data('users', $additional_data), $data);

        $this->ion_auth->trigger_events('extra_set');

        $this->db->insert('users', $user_data);


        $id = $this->db->insert_id();

        //create data
        $this->db->insert('user_data', array('user_id' => $id));


        if (!empty($groups)) {
            //add to groups
            foreach ($groups as $group) {
                $this->ion_auth->add_to_group($group, $id);
            }
        }

        //add to default group if not already set
        $default_group = $this->ion_auth->where('name', $this->config->item('default_reg_group', 'ion_auth'))->group()->row();
        if ( (isset($default_group->id) && empty($groups)) || (!empty($groups) && !in_array($default_group->id, $groups))) {
            $this->ion_auth->add_to_group($default_group->id, $id);
        }

        $this->ion_auth->trigger_events('post_register');

        return (isset($id)) ? $id : FALSE;
    }
    //log the user in

    function page($page, $data = array())
    {
        $this->load->view('auth/header');
        $this->load->view('auth/' . $page, $data);
        $this->load->view('auth/footer');
    }

    //log the user out

    function forgot_password()
    {
        $this->form_validation->set_rules('email', lang('email'), 'required|valid_email');
        if ($this->form_validation->run() == false) {
            if ($this->config->item('identity', 'ion_auth') == 'username') {
                $this->data['identity_label'] = 'username';
            } else {
                $this->data['identity_label'] = 'email';
            }
            validation_errors();
            $this->page('forgot_password');

        } else {
            // get identity from username or email
            if ($this->config->item('identity', 'ion_auth') == 'username') {
                $identity = $this->ion_auth->where('username', strtolower($this->input->post('email')))->users()->row();
            } else {
                $identity = $this->ion_auth->where('email', strtolower($this->input->post('email')))->users()->row();
            }
            if (empty($identity)) {
                flash('danger', lang('forgot_password_email_not_found'));
                redirectPrev();
            }

            //run the forgotten password method to email an activation code to the user
            $forgotten = $this->ion_auth->forgotten_password($identity->{$this->config->item('identity', 'ion_auth')});

            if ($forgotten) {
                //if there were no errors
                flash('success', lang('password_reset_link_sent'));
                redirect("login", 'refresh');
            } else {
                flash('danger', lang('request_error'));
                redirect('forgot_password');
            }
        }
    }

    //forgot password

    public function reset_password($code = NULL)
    {

        if (!$code) {
            show_404();
        }

        $user = $this->ion_auth->forgotten_password_check($code);

        if ($user) {
            //if the code is valid then display the password reset form

            $this->form_validation->set_rules('new', $this->lang->line('reset_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
            $this->form_validation->set_rules('new_confirm', $this->lang->line('reset_password_validation_new_password_confirm_label'), 'required');

            if ($this->form_validation->run() == false) {
                //display the form

                //set the flash data error message if there is one
                $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

                $this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
                $this->data['new_password'] = array(
                    'name' => 'new',
                    'id' => 'new',
                    'type' => 'password',
                    'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$',
                );
                $this->data['new_password_confirm'] = array(
                    'name' => 'new_confirm',
                    'id' => 'new_confirm',
                    'type' => 'password',
                    'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$',
                );
                $this->data['user_id'] = array(
                    'name' => 'user_id',
                    'id' => 'user_id',
                    'type' => 'hidden',
                    'value' => $user->id,
                );
                $this->data['csrf'] = $this->_get_csrf_nonce();
                $this->data['code'] = $code;

                //render
                page('reset_password', $this->data);
            } else {
                // do we have a valid request?
                if ($this->_valid_csrf_nonce() === FALSE || $user->id != $this->input->post('user_id')) {

                    //something fishy might be up
                    $this->ion_auth->clear_forgotten_password_code($code);

                    show_error($this->lang->line('error_csrf'));

                } else {
                    // finally change the password
                    $identity = $user->{$this->config->item('identity', 'ion_auth')};

                    $change = $this->ion_auth->reset_password($identity, $this->input->post('new'));

                    if ($change) {
                        //if the password was successfully changed
                        flash('success', $this->ion_auth->messages());
                        $this->logout();
                    } else {
                        flash('danger', $this->ion_auth->errors());
                        redirect('reset_password/' . $code, 'refresh');
                    }
                }
            }
        } else {
            //if the code is invalid then send them back to the forgot password page
            flash('danger', $this->ion_auth->errors());
            redirect("forgot_password", 'refresh');
        }
    }

    //reset password - final step for forgotten password

    function _get_csrf_nonce()
    {
        $this->load->helper('string');
        $key = random_string('alnum', 8);
        $value = random_string('alnum', 20);
        $this->session->set_flashdata('csrfkey', $key);
        $this->session->set_flashdata('csrfvalue', $value);

        return array($key => $value);
    }

    function _valid_csrf_nonce()
    {
        if ($this->input->post($this->session->flashdata('csrfkey')) !== FALSE &&
            $this->input->post($this->session->flashdata('csrfkey')) == $this->session->flashdata('csrfvalue')) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function logout()
    {
        $this->data['title'] = "Logout";

        //log the user out
        $this->ion_auth->logout();

        //redirect them to the login page
      //  redirect('login', 'refresh');
    }
    /*
     *
     replaced with conf->page($page,$data);

        function _render_page($view, $data = NULL, $render = false)
        {

            $this->viewdata = (empty($data)) ? $this->data : $data;


            $view_html = page($view, $this->viewdata, $render);

            if (!$render) return $view_html;
        }
     */
}
