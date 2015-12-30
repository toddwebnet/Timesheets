<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {


    public function index()
    {
        $this->loginForm("");
    }

    private function loginForm($Message)
    {
        $this->load->view('login');
    }

    public function proc()
    {
       print_r($_POST);
    }

    private function checkRememberMe()
    {
        
    }
}
