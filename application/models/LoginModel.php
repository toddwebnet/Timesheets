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
        $sql = "SELECT salt, password FROM security_user WHERE active_ind = 1 and username = ?";
        $param = array($username);
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

    public function usernameExists($username)
    {
        $sql = "select count(*) num_users from security_user where active_ind = 1 and username = ?";
        $param = array($username);
        $results = getFirstResultFromQuery($sql, $param);
        return ($results->num_users > 0)?true:false;
    }

    public function getUserInfoFromUsername($username)
    {
        $sql = "select su.user_id, su.username, c.first_name, c.last_name
            from security_user su
            inner join contact c on c.contact_id = su.contact_id
            where su.active_ind = 1 and su.username = ?";
        $param = array($username);
        return getFirstResultFromQuery($sql, $param);

    }
}