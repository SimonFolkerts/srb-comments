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
            $formPassword = $this->input->post('password');
            $userPassword = $user ? $user->password : null;
            $userEmail = $user ? $user->email : null;
            $this->form_validation->set_rules('email', 'Email', array('required', 'valid_email', 'callback_checkUser[' . $userEmail . ']'));
            $this->form_validation->set_rules('password', 'Password', array('required', 'callback_checkPassword[' . $userPassword . ']'));
            $this->form_validation->run();
        }
        $this->loadView('auth', $data);
    }

    private function getUserByEmail($email) {
        $query = $this->db->query('SELECT * FROM users WHERE users.email = ?', array($email));
        $user = $query->custom_row_object(0, 'User');
        return $user;
    }

    public function checkUser($field, $userEmail) {
        if ($userEmail === $field) {
            return true;
        } else {
            $this->form_validation->set_message('checkUser', 'Incorrect Email');
            return false;
        }
    }

    public function checkPassword($formPassword, $userPassword) {
        if ($formPassword === $userPassword) {
            return true;
        } else {
            var_dump('false');
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
