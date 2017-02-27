<?php

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User');
    }

    function index() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->input->post()) {
            //validate
            //if validation passed
            //get user
            $email = $this->input->post('email');
            $user = $this->getUserByEmail($email);
            //check password
            var_dump($this->checkPassword($user));
        }
        $this->loadView('auth', $data);
    }

    private function getUserByEmail($email) {
        $query = $this->db->query('SELECT * FROM users WHERE users.email = ?', array($email));
        $user = $query->custom_row_object(0, 'User');
        return $user;
    }

    private function checkPassword($user) {
        $dbPassword = $user->password;
        $userPassword = $this->input->post('password');
        if ($dbPassword === $userPassword) {
            return true;
        } else {
            return false;
        }
    }
    
    private function prepInput($input) {
        
    }
        

    private function loadView($view, $data) {
        $this->load->view('header');
        $this->load->view('css');
        $this->load->view($view, $data);
        $this->load->view('footer');
    }

}
