<?php
function ecr($password, $salt = null)
{
    if($salt == null) {
        $salt = substr(strtr(base64_encode(openssl_random_pseudo_bytes(22)), '+', '.'), 0, 22);
    }
    $hash = crypt($password, '$2y$12$' . $salt);
    return array(
        "salt"=>$salt,
        "hash"=>$hash
    );
}

print_r(ecr("admin"));