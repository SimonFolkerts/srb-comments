<?php
//TODO make validation part of user model for use with CI validation
class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User');
    }

    function index() {

        $data = null;
        $this->load->library('form_validation');


        if ($this->input->post()) {
            $email = $this->input->post('email');
            $user = $this->getUserByEmail($email);
            $this->form_validation->set_rules('email', 'Email', array('required', 'valid_email', $this->checkUser($user)));
            $this->form_validation->set_rules('password', 'Password', array('required', $this->checkPassword($user)));
            $this->form_validation->run();
        }

        $this->loadView('auth', $data);
    }

    private function getUserByEmail($email) {
        $query = $this->db->query('SELECT * FROM users WHERE users.email = ?', array($email));
        $user = $query->custom_row_object(0, 'User');
        return $user;
    }

    public function checkUser($user) {
        if ($user) {
            return true;
        } else {
            $this->form_validation->set_message('checkUser', 'There is no account with this email address');
            return false;
        }
    }

    public function checkPassword($user) {
        if ($user) {
            $dbPassword = $user->password;
            $userPassword = $this->input->post('password');
            if ($dbPassword === $userPassword) {
                return true;
            } else {
                $this->form_validation->set_message('checkPassword', 'Incorrect password');
                return false;
            }
        } else {
            $this->form_validation->set_message('checkPassword', 'Incorrect password');
            return false;
        }
    }

    private function loadView($view, $data) {
        $this->load->view('header');
        $this->load->view('css');
        $this->load->view($view, $data);
        $this->load->view('footer');
    }

}
