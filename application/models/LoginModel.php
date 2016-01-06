<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class LoginModel extends CI_Model
{
    public function encrypt($password, $salt = null)
    {
        if ($salt == null)
        {
            $salt = substr(strtr(base64_encode(openssl_random_pseudo_bytes(22)), '+', '.'), 0, 22);
        }

        $hash = crypt($password, '$2y$12$' . $salt);
        return (object)array(
            "password" => $password,
            "salt" => $salt,
            "hash" => $hash
        );
    }

    public function validateCredentials($username, $password)
    {
        $sql = "SELECT salt, password FROM security_user WHERE username = ?";
        $param = array(":username" => $username);
        $userObj = getFirstResultFromQuery($sql, $param);
        if (!$userObj)
        {
            return false;
        }
        $encrypted = $this->encrypt($password, $userObj->salt);
        if ($encrypted->hash == $userObj->password)
        {
            return true;
        }
        else
        {
            return false;
        }

    }
}