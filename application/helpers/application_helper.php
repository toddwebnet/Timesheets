<?php

function getSessionArray()
{
    $ci = &get_instance();
    return $ci->session->userdata;
}
function checkLoggedIn()
{
    $ci = &get_instance();
    $user_id = $ci->session->userdata("user_id");
    $username = $ci->session->userdata("username");
    if(!is_numeric($user_id) || empty($username))
    {
        redirect("/login");
    }
}