<?php

use Hotel\User;
use Hotel\Favorite;

//Boot application
require_once __DIR__.'/../../../boot/boot.php';


//Return to Home page if not a POST request
if (strtolower($_SERVER['REQUEST_METHOD']) != 'post'){
    echo "This is a post script,";
    die;
}

//If there is NO logged User return to main
if (empty(User::getCurrentUserId())) {
   echo "No current user logged for this operation";
   die;
} 

//Check if room_id is given
$roomId = $_POST['room_id'];
if (empty($roomId)) {
   echo "No room is given for this operation";
   die;
}

// Set room to favorites
$favorite =  new Favorite();

//Add or Remove room from favorites 
$isFavorite = $_POST['is_favorite'];

if(!$isFavorite){
    $favorite->setFavorite($roomId, User::getCurrentUserId());
}else {
    $favorite->unsetFavorite($roomId, User::getCurrentUserId());
}


//Checks and Returns TRUE if room is favorite by looged user
echo json_encode($favorite->isFavorite($roomId, User::getCurrentUserId()));

