<?php if(!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Conf extends CI_Model
{

    public function __construct()
    {
        // reload_company();
        init_company();
//        dd(session('company_top_nav_bg_color'));

        if(!empty(session('timezone'))) {
            date_default_timezone_set(session('timezone'));
        } else {
            date_default_timezone_set('America/New_York');
        }

        $this->setLanguage();

        $this->load->model('My_child', 'child');
        $this->load->model('My_user', 'user');
        $this->load->model('My_cron', 'cron');
        $this->load->model('My_mailer', 'mailer');
        $this->load->model('My_rooms', 'rooms');
        $this->load->model('My_parent', 'parent');

        //disable changes to db in demo mode
        demo();
        //check if site in in maintenance
        maintenance();
        //enforce encryption
        //$this->check_encrypt_key();
        setRedirect(); //remember current page

        //enable profiler in dev
        $this->profiler();

    }

    /**
     * enable debug bar
     * Enabling this may interfere with ajax requests
     *
     * @param string $env
     */
    function profiler($env = 'development')
    {
        if(config_item('log_threshold') > 0 && ENVIRONMENT == $env) {
            $this->output->enable_profiler(TRUE);
            // $this->console->exception(new Exception('test exception'));
            // $this->console->debug('Debug message');
            // $this->console->info('Info message');
            // $this->console->warning('Warning message');
            // $this->console->error('Error message');
            $this->console->info($this->session->userdata);
        }
    }

    /**
     * set language to session
     */
    function setLanguage()
    {
        $langFiles = $this->loadLanguageFiles();

        if(isset($_GET['language'])) {
            $lang = $_GET['language'];

            if(!is_dir(APPPATH.'language/'.$lang))
                redirectPrev('Language not found');

            if(!in_array($lang, $this->getLanguages()))
                session(['language' => config_item('language')]);
            session(['language' => $lang]);
        }
        $this->config->set_item('language', session('language'));

        $this->lang->load($langFiles, session('language'));
    }

    /**
     * @return mixed
     */
    function getLanguage()
    {
        if(session('language'))
            return session('language');
        return config_item('language');
    }

    function getLanguages()
    {
        $dir = new DirectoryIterator(APPPATH.'language');
        $languages = [];
        foreach ($dir as $fileinfo) {
            if($fileinfo->isDir() && !$fileinfo->isDot()) {
                $languages[] = $fileinfo->getFilename();
            }
        }
        return $languages;
    }

    /**
     * @param array $replace
     *
     * @return mixed
     */
    function loadLanguageFiles(Array $replace = [])
    {
        static $autoload;

        if(empty($autoload)) {
            $file_path = APPPATH.'config/autoload.php';
            $found = FALSE;
            if(file_exists($file_path)) {
                $found = TRUE;
                require($file_path);
            }
            if(file_exists($file_path = APPPATH.'config/'.ENVIRONMENT.'/autoload.php')) {
                require($file_path);
            } elseif(!$found) {
                set_status_header(503);
                echo 'The configuration file does not exist.';
                exit(3); // EXIT_CONFIG
            }

            // Does the $config array exist in the file?
            if(!isset($autoload) OR !is_array($autoload)) {
                set_status_header(503);
                echo 'Your config file does not appear to be formatted correctly.';
                exit(3); // EXIT_CONFIG
            }
        }

        // Are any values being dynamically added or replaced?
        foreach ($replace as $key => $val) {
            $autoload[$key] = $val;
        }
        return $autoload['language'];
    }

    /**
     * @param $db
     * @param $id
     * @param $item
     *
     * @return string
     */
    public function db_read($db, $id, $item)
    {
        $this->db->where('id', $id);
        $this->db->limit(1);
        foreach ($this->db->get($db)->result() as $row) {
            return $row->$item;
        }
        return '';
    }

    public function totalRecords($db, $data = [])
    {
        if(!empty($data)) {
            foreach ($data as $field => $key) {
                $this->db->where($field, $key);
            }
        }
        $query = $this->db->get($db);
        return $query->num_rows();
    }

    /*
     * check_encrypt_key
     * verify encryption key is set
     * @params none
     * @return void
     */
    public function check_encrypt_key()
    {
        $this->load->helper('language');
        if(logged_in()) {
            if(empty($this->config->item('encryption_key'))) {
                flash('danger', lang('encryption_key_warning'));
                //redirect('admin#settings');
            }
        }
    }

    //lockscreen timer
    public function setTimer($time = 1)
    {
        $cookie = [
            'name' => 'timer',
            'value' => $time,
            'expire' => '86500',
            'path' => '/',
            'secure' => TRUE,
        ];
        $this->input->set_cookie($cookie);
    }

    public function getTimer()
    {
        $this->input->cookie('timer');
    }

    public function stripImage($text)
    {
        $text = preg_replace('/<img[^>]+./', ' ', $text);
        $text = str_replace(']]>', ']]>', $text);
        return $text;
    }

    /**
     * Resize an image and overwrite
     *
     */
    public function photoResize($data = [])
    {
        $config['image_library'] = 'gd2';
        $config['source_image'] = $data['image'];
        $config['create_thumb'] = isset($data['thumb']) ? $data['thumb'] : FALSE;
        $config['maintain_ratio'] = isset($data['ratio']) ? $data['ratio'] : TRUE;
        $config['width'] = isset($data['width']) ? $data['width'] : 200;
        $config['height'] = isset($data['height']) ? $data['height'] : 200;

        $this->load->library('image_lib', $config);

        $this->image_lib->resize();
    }
}
