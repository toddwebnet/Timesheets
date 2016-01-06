<?php

class ToddCrypt
{
    var $key;
    public function __construct()
    {
        $this->key = $this->getKey();
    }

    private function getKey()
    {
        $ci = &get_instance();
        return $ci->config->item("encryption_key");

    }
    function encrypt($toEncrypt)
    {

        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        return base64_encode($iv . mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $this->key, $toEncrypt, MCRYPT_MODE_CBC, $iv));
    }

    function decrypt($toDecrypt)
    {

        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC);
        $toDecrypt = base64_decode($toDecrypt);
        return rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $this->key, substr($toDecrypt, $iv_size), MCRYPT_MODE_CBC, substr($toDecrypt, 0, $iv_size)));
    }
} // end of class