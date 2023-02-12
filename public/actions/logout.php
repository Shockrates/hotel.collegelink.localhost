<?php

//Boot application
require_once __DIR__.'/../../boot/boot.php';

use Hotel\User;

//Return to Home page if not a POST request
if (strtolower($_SERVER['REQUEST_METHOD']) != 'post'){
    header('Location: /');

    return;
   
}

//Check for existing logged user
if (empty(User::getCurrentUserId())){
    //Return to HOME page
    header('Location: /');
    die;
}

//Verify csrf
$csrf = $_POST['csrf'];
if (empty($csrf) || !User::verifyCsrf($csrf)){
    header('Location: /');
    return;
}

setcookie('user_token', $token, time() - 3600, '/');
//Return to HOME page
header('Location: /');

