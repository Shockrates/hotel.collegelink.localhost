<?php

use Hotel\User;
use Hotel\Favorite;

//Boot application
require_once __DIR__.'/../../boot/boot.php';


//Return to Home page if not a POST request
if (strtolower($_SERVER['REQUEST_METHOD']) != 'post'){
    header('Location: /');

    return;
}

//If there is NO logged User return to main
if (empty(User::getCurrentUserId())) {
    header('Location: /');

    return;
} 

//Check if room_id is given
$roomId = $_POST['room_id'];
if (empty($roomId)) {
    header('Location: /');

    return;
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

//return to room page
//header(sprintf('Location: /room/?room_id=%s', $roomId));

echo json_encode($favorite->isFavorite($roomId, User::getCurrentUserId()));

