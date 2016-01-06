<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {

        $d["message"] = "Word to your mother";
        $d["encrypted"] = openssl_encrypt($d["message"], 'aes128', '123');
        print_rr($d);


    }
}
