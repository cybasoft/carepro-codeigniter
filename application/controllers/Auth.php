<?php
use phpDocumentor\Reflection\Types\Null_;

defined('BASEPATH') or exit('No direct script access allowed');

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
        $this->conf->setTimer(0);
    }

    function index()
    {
        $this->login();
    }

    function login()
    {
        if ($this->ion_auth->logged_in()) {
            redirect('dashboard', 'refresh');
        }
        $this->refreshCaptcha();

        if (!empty($this->input->post('email'))) {
            $this->form_validation->set_rules('email', lang('email'), 'required');
            $this->form_validation->set_rules('password', lang('password'), 'required');
            if (session('company_enable_captcha') == 1)
                $this->form_validation->set_rules('captcha', lang('captcha'), 'required|callback_validate_captcha');

            if ($this->form_validation->run() == true) {
                $email = $this->input->post('email');
                $password = $this->input->post('password');
                $login = $this->ion_auth->login($email, $password);

                $user_details = $this->db->get_where('users', array(
                    'email' => $email
                ));
                $users = $user_details->row_array();
                $daycare_details = $this->db->get_where('daycare', array(
                    'id' => $users['daycare_id']
                ));
                $daycare = $daycare_details->row_array();                
                if ($login == "1") {
                    $check_parent = $this->session->userdata("users");
                    $this->session->set_userdata('owner_daycare_id', $daycare['daycare_id']);
                    $users_details = $this->db->get_where('users', array(
                        'email' => $email,
                    ));
                    $users = $users_details->row_array();
                    if ($users['daycare_id'] === $daycare['id']) {
                        if ($check_parent === "parent") {
                            redirect('parents', 'refresh');
                        } else {
                            redirect('dashboard', 'refresh');
                        }
                    }
                } else if($login == 'error'){
                    flash('error', 'Temporarily Locked Out.  Try again later.');
                    redirect('login');
                }else{
                    flash('error', 'Username or password is incorrect');
                    redirect('login');
                }
            } else {
                validation_errors();
                flash('error');
            }
        } else {
            $captcha = $this->captcha();
            $data['captcha'] = array(
                'type' => 'text',
                'name' => 'captcha',
                'class' => 'form-control input100',
                'required' => 'required',
                'style' => 'border:solid 1px #ccc',
                'placeholder' => 'Captcha'
            );
            $data['captcha_image'] = $captcha['image'];

            //daycare logo
            // if ($daycare_id !== Null) {
            //     $query = $this->db->get_where('daycare', array(
            //         'daycare_id' => $daycare_id
            //     ));
            //     $result = $query->result();
            //     $logo = $result[0]->logo;
            //     $image = $logo;
            //     $daycare = 'yes';
            // } else {
            //     $logo = '';
            //     $image = "";
            //     $daycare = 'no';
            // }
            // $this->session->set_userdata('company_logo', $logo);
            // $data['logo'] = $image;
            // $data['daycare'] = $daycare;
            // $data['daycare_id'] =  $daycare_id;
            $this->page('login', compact('data'));
        }
    }
    function register()
    {
        $daycareId = $this->input->post('daycare');
        $this->session->set_userdata('parent_daycare', $daycareId);
        if ($this->ion_auth->logged_in()) redirect('dashboard', 'refresh');

        $this->refreshCaptcha();

        $this->form_validation->set_rules('email', lang('email'), 'required|is_unique[users.email]');
        $this->form_validation->set_rules('password', lang('password'), 'required|callback_validate_password');
        $this->form_validation->set_rules('password_confirm', lang('password_confirmation'), 'required');
        $this->form_validation->set_rules('first_name', lang('first_name'), 'required');
        $this->form_validation->set_rules('last_name', lang('last_name'), 'required');
        $this->form_validation->set_rules('phone', lang('phone'), 'required');

        if (session('company_enable_captcha') == 1)
            $this->form_validation->set_rules('captcha', lang('captcha'), 'required|callback_validate_captcha');

        if ($this->form_validation->run() == true) {

            $data = array(
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'phone' => $this->input->post('phone'),
                'activation_code' => time() + rand(111, 999),
                'address' => $this->input->post('address')
            );

            if ($this->auth->register($data, 'parent')) {
                flash('success', lang('Registration successful'));

                // if($this->ion_auth->login($this->input->post('email'), $this->input->post('password'))) {
                //     redirect('dashboard', 'refresh');
                // }
                redirect('login');
            } else {
                flash('error', lang('request_error'));
                redirectPrev();
            }
        } else {
            //the user is not logging in so display the login page
            if (!empty($this->input->post('email'))) {
                validation_errors();
                flash('danger');
            }

            $data['email'] = array(
                'name' => 'email',
                'type' => 'email',
                'value' => set_value('email'),
                'class' => 'input100',
                'required' => 'required'
            );
            $data['first_name'] = array(
                'name' => 'first_name',
                'type' => 'text',
                'value' => set_value('first_name'),
                'class' => 'input100',
                'required' => 'required'
            );
            $data['last_name'] = array(
                'name' => 'last_name',
                'type' => 'text',
                'value' => set_value('last_name'),
                'class' => 'input100',
                'required' => 'required'
            );
            $data['phone'] = array(
                'name' => 'phone',
                'type' => 'text',
                'value' => set_value('phone'),
                'class' => 'input100',
                'required' => 'required'
            );
            $data['address'] = array(
                'name' => 'address',
                'value' => set_value('address'),
                'class' => 'input100',
                'required' => 'required',
                'rows' => 3
            );
            $data['password'] = array(
                'name' => 'password',
                'type' => 'password',
                'class' => 'input100',
                'required' => 'required'
            );
            $data['password_confirm'] = array(
                'name' => 'password_confirm',
                'type' => 'password',
                'class' => 'input100',
                'required' => 'required'
            );
            $captcha = $this->captcha();
            $data['captcha'] = array(
                'name' => 'captcha',
                'required' => 'required',
                'class' => 'form-control input100',
                'style' => 'border:solid 1px #ccc',
                'placeholder' => 'Captcha'
            );
            //daycare logo
            if ($daycareId !== Null) {
                $query = $this->db->get_where('daycare', array(
                    'daycare_id' => $daycareId
                ));
                $result = $query->result();
                $logo = $result[0]->logo;
                $image = $logo;
            } else {
                $image = "";
            }
            $data['logo'] = $image;
            $data['captcha_image'] = $captcha['image'];
            $data['daycare_id'] = $daycareId;
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
            'img_width' => '150',
            'show_grid' => FALSE,
            'img_height' => 28,
            'expiration' => 3600,
            'font_size' => 30,
            'colors' => array(
                'background' => array(247, 247, 247),
                'border' => array(247, 247, 247),
                'text' => array(102, 117, 223),
                'grid' => array(255, 255, 255)
            )
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
        if (session('company_maintenance_mode') == 1) {
            $this->load->view('errors/maintenance');
        } else {
            $this->load->view('auth/' . $page, $data);
        }
        $this->load->view('auth/footer');
    }

    //log the user out

    function forgot()
    {
        if (!empty($this->input->post('email'))) {
            $this->form_validation->set_rules('email', lang('email'), 'required|valid_email');
            if ($this->form_validation->run() == false) {
                $this->data['identity_label'] = 'email';
                validation_errors();
                flash('danger');
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
                    redirect('login');
                } else {
                    flash('danger', lang('request_error'));
                    redirect('forgot');
                }
            }
        }
        // $daycare_details = $this->db->get_where("daycare", array(
        //     'daycare_id' => $daycare_id
        // ));
        // $daycare = $daycare_details->row_array();
        // if ($daycare['logo'] !== NULL) {
        //     $logo = $daycare['logo'];
        // } else {
        //     $logo = '';
        // }
        // $data = array(
        //     'daycare_id' => $daycare_id,
        //     'logo' => $logo
        // );
        $this->page('forgot_password', $data = []);
    }

    //forgot password

    public function reset($code = NULL)
    {
        if (!$code) {
            flash('error', lang('invalid_request'));
            redirect('auth/forgot');
        }

        $user = $this->ion_auth->forgotten_password_check($code);
        if ($user) {
            $this->form_validation->set_rules('new', $this->lang->line('reset_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
            $this->form_validation->set_rules('new_confirm', $this->lang->line('reset_password_validation_new_password_confirm_label'), 'required');

            if ($this->form_validation->run() == false) {

                if ($this->input->post('new')) {
                    validation_errors();
                    flash('danger');
                }

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
                if ($this->_valid_csrf_nonce() === FALSE || $user->id != $this->input->post('user_id')) {
                    //something fishy might be up
                    $this->ion_auth->clear_forgotten_password_code($code);
                    show_error($this->lang->line('error_csrf'));
                } else {
                    // finally change the password
                    $identity = $user->{$this->config->item('identity', 'ion_auth')};
                    $change = $this->ion_auth->reset_password($identity, $this->input->post('new'));
                    if ($change) {
                        //Login if the password was successfully changed
                        flash('success', $this->ion_auth->messages());
                        if ($this->ion_auth->login($identity, $this->input->post('new'))) {
                            redirect('dashboard', 'refresh');
                        } else {
                            flash('error', 'Username or password is incorrect');
                            redirect('auth/login', 'refresh');
                        }
                    } else {
                        flash('danger', $this->ion_auth->errors());
                        redirectPrev();
                    }
                }
            }
        } else {
            flash('danger', $this->ion_auth->errors());
            redirect("auth/forgot", 'refresh');
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
        if (
            $this->input->post($this->session->flashdata('csrfkey')) !== FALSE &&
            $this->input->post($this->session->flashdata('csrfkey')) == $this->session->flashdata('csrfvalue')
        ) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function logout($daycare_id = NULL)
    {
        $this->data['title'] = "Logout";

        //log the user out
        $this->ion_auth->logout();
        $this->conf->setTimer(0);
        reload_company();
        $this->session->unset_userdata('users');
        //redirect them to the login page
        if ($daycare_id !== NULL) {
            redirect($daycare_id . '/login', 'refresh');
        } else {
            redirect('auth/login', 'refresh');
        }
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
