<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {


    public function index()
    {

        $this->loginForm("");
    }

    private function loginForm($message)
    {
        $this->load->view('login', array("message"=>$message));
    }

    public function proc()
    {

        $username = $this->input->post("login-user");
        $password = $this->input->post("login-password");
        $remember = (bool)$this->input->post("login-remember-me");
        var_dump($remember);
        $this->load->model("LoginModel");
        if($this->LoginModel->validateCredentials($username, $password))
        {}
        else{
            $this->loginForm("Invalid Credentials");
        }
    }

    private function registerLogin($username)
    {

    }
    private function registerRememberMe($username, $remember)
    {

    }

    private function checkRememberMe()
    {
        
    }
}
