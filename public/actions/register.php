<?php

//Boot application
require_once __DIR__.'/../../boot/boot.php';


//Return to Home page if not a POST request
if (strtolower($_SERVER['REQUEST_METHOD']) != 'post'){
    header('Location: /');

    return;
}

use Hotel\User;


//Create new User
$user = new User();
$user->insertUser($_REQUEST['username'], $_REQUEST['email'], $_REQUEST['password']);

//Retrieve User Info
$userInfo = $user->getByEmail($_REQUEST['email']);

// Generate token
$token = $user->generateToken($userInfo['user_id']);

//Set cookie to browser
setcookie('user_token', $token, time() + (30 * 12 * 60* 60), '/');

//Return to HOME page
header('Location: /public/index.php');


