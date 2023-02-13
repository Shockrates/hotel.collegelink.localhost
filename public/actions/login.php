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
if (!empty(User::getCurrentUserId())){
    //Return to HOME page
    header('Location: /');
    die;
}


//Verify User
$user = new User();
try{
    if(!$verified = $user->verifyUser($_REQUEST['email'], $_REQUEST['password'])){
        header('Location: /login.php?error=Could not verify user');
        return;
    }
} catch (InvalidArgumentException $ex){
    header('Location: /login.php?error=No user exists with given mail');
    return;
}




if ($verified) {
    //Retrieve User Info
    $userInfo = $user->getByEmail($_REQUEST['email']);

    // Generate token
    $token = $user->generateToken($userInfo['user_id']);

    //Set cookie to browser
    setcookie('user_token', $token, time() + (1 * 12 * 60* 60), '/');

    //Return to HOME page
    header('Location: /');
} else {
    //Set invalid message cookie to browser
    setcookie('invalid_credentials', true, time() + (3), '/');
    //Return to Login with a validaif credentials 
    header('Location: /login.php');
}






