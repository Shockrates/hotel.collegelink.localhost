<?php

require_once __DIR__.'/autoload.php';
//require_once __DIR__.'\\Hotel\\User.php';

use \Hotel\User;
//use \Hotel\Room;

$user = new User();


//Create New User
//$status = $user->insertUser('Example-User', 'eg@example.com', 'asdfasdf1234');
//var_dump($status);


$userList = $user->getUserList(); 
print_r($userList);

// $room = new Room();
// var_dump(get_class($room));

var_dump(__DIR__);