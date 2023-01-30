<?php

require_once __DIR__.'/../boot/boot.php';
//require_once __DIR__.'\\..\\Hotel\\User.php';

use Hotel\User;

$user = new User();


//Create New User
// $status = $user->insertUser('Hash-Example-User', 'hasheg@example.com', 'asdfasdf12345');
// var_dump($status);


// $userList = $user->getUserList(); 
// print_r($userList);

$verified = $user->verifyUser('hasheg@example.com', 'asdfasdf12345');
var_dump($verified);