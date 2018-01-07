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
        $this->load->model('ion_auth_model', 'auth');
        $this->lang->load('auth');
        $this->load->helper('language');
    }

    function index()
    {
        redirect('login');
    }

    function login()
    {
        $this->refreshCaptcha();
        $this->form_validation->set_rules('email', lang('email'), 'required');
        $this->form_validation->set_rules('password', lang('password'), 'required');
        if (config_item('enable_captcha') == true)
            $this->form_validation->set_rules('captcha', lang('captcha'), 'required|callback_validate_captcha');

        if ($this->form_validation->run() == true) {
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            if ($this->ion_auth->login($email, $password)) {
                redirect('dashboard', 'refresh');
            } else {
                flash('error', 'Username or password is incorrect');
            }
        } else {
            validation_errors();
            flash('error');
        }

        $data['email'] = array(
            'name' => 'email',
            'type' => 'email',
            'value' => set_value('email'),
            'class' => 'form-control',
            'placeholder' => 'Email',
            'required' => 'required'
        );
        $data['password'] = array(
            'name' => 'password',
            'type' => 'password',
            'class' => 'form-control',
            'placeholder' => 'Password',
            'required' => 'required'
        );
        $captcha = $this->captcha();
        $data['captcha'] = array(
            'name' => 'captcha',
            'class' => 'form-control',
            'required' => 'required',
            'placeholder' => lang('captcha_placeholder')
        );
        $data['captcha_image'] = $captcha['image'];
        $this->page('login', compact('data'));
    }

    function register()
    {
        $this->refreshCaptcha();
        $this->form_validation->set_rules('email', lang('email'), 'required|is_unique[users.email]');
        $this->form_validation->set_rules('password', lang('password'), 'required|callback_validate_password');
        $this->form_validation->set_rules('password_confirm', lang('password_confirmation'), 'required');
        $this->form_validation->set_rules('first_name', lang('first_name'), 'required');
        $this->form_validation->set_rules('last_name', lang('last_name'), 'required');
        $this->form_validation->set_rules('phone', lang('phone'), 'required');
        if (config_item('enable_captcha') == true)
            $this->form_validation->set_rules('captcha', lang('captcha'), 'required|callback_validate_captcha');
        if ($this->form_validation->run() == true) {
            $groups = array(4);
            $data = array(
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'phone' => $this->input->post('phone'),
                'activation_code' => time() + rand(111, 999),
                'address' => $this->input->post('address')
            );
            if ($this->auth->register($data, $groups)) {
                flash('success', lang('request_success'));
                if ($this->ion_auth->login($this->input->post('email'), $this->input->post('password'))) {
                    redirect('dashboard', 'refresh');
                }
            } else {
                flash('error', lang('request_error'));
                redirectPrev();
            }
        } else {
            //the user is not logging in so display the login page
            validation_errors();
            flash('danger');
            $data['email'] = array(
                'name' => 'email',
                'type' => 'email',
                'value' => set_value('email'),
                'class' => 'form-control',
                'placeholder' => 'Email',
                'required' => 'required'
            );
            $data['first_name'] = array(
                'name' => 'first_name',
                'type' => 'text',
                'value' => set_value('first_name'),
                'class' => 'form-control',
                'placeholder' => lang('first_name'),
                'required' => 'required'
            );
            $data['last_name'] = array(
                'name' => 'last_name',
                'type' => 'text',
                'value' => set_value('last_name'),
                'class' => 'form-control',
                'placeholder' => lang('last_name'),
                'required' => 'required'
            );
            $data['phone'] = array(
                'name' => 'phone',
                'type' => 'text',
                'value' => set_value('phone'),
                'class' => 'form-control',
                'placeholder' => lang('phone'),
                'required' => 'required'
            );
            $data['address'] = array(
                'name' => 'address',
                'value' => set_value('address'),
                'class' => 'form-control',
                'placeholder' => lang('address'),
                'required' => 'required',
                'rows' => 3
            );
            $data['password'] = array(
                'name' => 'password',
                'type' => 'password',
                'class' => 'form-control',
                'placeholder' => lang('password'),
                'required' => 'required'
            );
            $data['password_confirm'] = array(
                'name' => 'password_confirm',
                'type' => 'password',
                'class' => 'form-control',
                'placeholder' => lang('password_confirmation'),
                'required' => 'required'
            );
            $captcha = $this->captcha();
            $data['captcha'] = array(
                'name' => 'captcha',
                'class' => 'form-control',
                'required' => 'required',
                'placeholder' => lang('captcha_placeholder')
            );
            $data['captcha_image'] = $captcha['image'];
            $this->page('register', compact('data'));
        }
    }

    public function validate_captcha($captcha)
    {
        if ((int)$captcha !== (int)$this->session->flashdata('captcha')) {
            $this->form_validation->set_message('validate_captcha', lang('invalid_captcha'));
            return false;
        } else {
            return true;
        }

    }

    /**
     * @return string
     */
    function captcha()
    {
        $this->load->helper('captcha');
        $data = array(
            'word' => rand(1111, 9999),
            'word_length' => 4,
            'img_path' => './application/temp/captcha/',
            'img_url' => base_url() . 'application/temp/captcha/',
            'font_path' => base_url() . 'system/fonts/texb.ttf',
            'img_width' => '200',
            'img_height' => 50,
            'expiration' => 3600
        );
        $this->session->set_flashdata('captcha', $data['word']);
        return create_captcha($data);
    }

    function refreshCaptcha()
    {
        $expiration = time() - 7200;
        $path = './application/temp/captcha/';
        $dir = new DirectoryIterator($path);
        foreach ($dir as $fileinfo) {
            if (!$fileinfo->isDot()) {
                $image = explode('.', $fileinfo->getFilename());
                $captcha = $image[0];
                if ($captcha < $expiration)
                    @unlink($path . $fileinfo->getFilename());
            }
        }
    }

    /**
     * @return bool
     */
    function validate_password($password)
    {
        $password_confirmation = $this->input->post('password_confirm');
        if ($password == $password_confirmation) {
            return true;
        } else {
            $this->form_validation->set_message('validate_password', lang('password_error'));
            return false;
        }
    }

    function page($page, $data = array())
    {
        $this->load->view('auth/header');
        if (config_item('maintenance_mode')) {
            $this->load->view('errors/maintenance');
        } else {
            $this->load->view('auth/' . $page, $data);
        }

        $this->load->view('auth/footer');
    }

    //log the user out

    function forgotPassword()
    {
        $this->form_validation->set_rules('email', lang('email'), 'required|valid_email');
        if ($this->form_validation->run() == false) {
            $this->data['identity_label'] = 'email';
            validation_errors();
            $this->page('forgot_password');

        } else {
            // get identity from username or email
            $identity = $this->ion_auth->where('email', strtolower($this->input->post('email')))->users()->row();
            if (empty($identity)) {
                flash('danger', lang('forgot_password_email_not_found'));
                redirectPrev();
            }
            //run the forgotten password method to email an activation code to the user
            $forgotten = $this->ion_auth->forgotten_password($identity->{$this->config->item('identity', 'ion_auth')});
            if ($forgotten) {
                //if there were no errors
                flash('success', lang('password_reset_link_sent'));
                redirectPrev();
            } else {
                flash('danger', lang('request_error'));
                redirectPrev();
            }
        }
    }

    //forgot password

    public function resetPassword($code = NULL)
    {
        if (!$code) {
            flash('error', lang('invalid_request'));
            redirect('password/forgot');
        }

        $user = $this->ion_auth->forgotten_password_check($code);
        if ($user) {
            $this->form_validation->set_rules('new', $this->lang->line('reset_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
            $this->form_validation->set_rules('new_confirm', $this->lang->line('reset_password_validation_new_password_confirm_label'), 'required');

            if ($this->form_validation->run() == false) {

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
                $this->page('reset_password', $this->data);
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
                        if ($this->ion_auth->login($identity, $this->input->post('new'))) {
                            redirect('dashboard', 'refresh');
                        } else {
                            flash('error', 'Username or password is incorrect');
                            redirect('login','refresh');
                        }
                    } else {
                        flash('danger', $this->ion_auth->errors());
                        redirectPrev();
                    }
                }
            }
        } else {
            flash('danger', $this->ion_auth->errors());
            redirect("password/forgot", 'refresh');
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
        redirect('login', 'refresh');
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
