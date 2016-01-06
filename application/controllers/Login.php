<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
{

    var $tc;

    public function __construct()
    {
        parent::__construct();
        $this->load->helper("cookie");
        $this->load->library("ToddCrypt");
        $this->load->model("LoginModel");
        $this->tc = new ToddCrypt();
    }

    public function index()
    {
        if ($this->doWeRemember())
        {
            $this->redirectToDashboard();
        }
        else
        {
            $this->loginForm("");
        }
    }

    private function loginForm($message)
    {
        $this->load->view('login', array("message" => $message));
    }

    public function proc()
    {

        $username = $this->input->post("login-user");
        $password = $this->input->post("login-password");
        $remember = (bool)$this->input->post("login-remember-me");

        if ($this->LoginModel->validateCredentials($username, $password))
        {
            $this->registerLogin($username);
            $this->registerRememberMe($username, $remember);
            $this->redirectToDashboard();
        }
        else
        {
            $this->loginForm("Invalid Credentials");
        }
    }

    private function redirectToDashboard()
    {
        redirect("/dashboard");
    }

    private function registerLogin($username)
    {
        $userInfo = (array)$this->LoginModel->getUserInfoFromUsername($username);
        $this->session->set_userdata($userInfo);

    }

    private function registerRememberMe($username, $remember)
    {
        if ($remember == 1)
        {

            $rememberedUserEncrypted = $this->tc->encrypt($username);
            //seconds * minutes * hours * days
            $oneMonth = 60 * 60 * 24 * 30;
            $domain = $_SERVER['SERVER_NAME'];
            $cookie = array(
                'name' => 'remembered_user',
                'value' => $rememberedUserEncrypted,
                'expire' => time() + $oneMonth,
                'domain' => "." . $domain,
                'path' => '/',
                'prefix' => 'timesheets_',
            );
            set_cookie($cookie);
        }
    }

    private function doWeRemember()
    {
        $rememberedUserInfo = get_cookie("timesheets_remembered_user");

        if (!empty($rememberedUserInfo))
        {
            $username = $this->tc->decrypt($rememberedUserInfo);
            if ($this->LoginModel->usernameExists($username))
            {
                $this->registerLogin($username);
                return true;
            }
        }
        return false;
    }

    public function logout()
    {
        $this->killSession();
        $this->killCookie();
        redirect("/login");
    }

    public function killCookie()
    {
        $domain = $_SERVER['SERVER_NAME'];
        $cookie = array(
            'name' => 'remembered_user',
            'value' => '',
            'expire' => 0,
            'domain' => "." . $domain,
            'path' => '/',
            'prefix' => 'timesheets_',
        );
        set_cookie($cookie);

    }

    public function killSession()
    {
        $sessionInfo = $this->session->all_userdata();
        foreach($sessionInfo as $key=>$value)
        {
            $sessionInfo[$key] = null;
        }
        $this->session->set_userdata($sessionInfo);

    }

    public function show()
    {
        $sessionInfo = $this->session->all_userdata();
        print_rr($sessionInfo);
        $rememberedUserInfo = get_cookie("timesheets_remembered_user");
        print_rr($rememberedUserInfo);

    }
}
