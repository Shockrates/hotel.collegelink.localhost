<?php

use Hotel\User;
use Hotel\Review;

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

//Verify csrf
$csrf = $_POST['csrf'];
if (empty($csrf) || !User::verifyCsrf($csrf)){
    header('Location: /');
    return;
}

// Add review
$review =  new Review();
$result = $review->insertReview($roomId, User::getCurrentUserId(), $_POST['rate'], $_POST['userComment']);

//return to room page
header(sprintf('Location: /room/?room_id=%s', $roomId));

