<?php

use Hotel\User;
use Hotel\Review;

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

// Add review
$review =  new Review();
$result = $review->insertReview($roomId, User::getCurrentUserId(), $_POST['rate'], $_POST['userComment']);


//Load logged user data
$user = new User();
$userData = $user->getById(User::getCurrentUserId());

//Set counter value is 0 because it will be prepended to review list so it will be on top
//Counter value will change with jscript
$counter = 0;

//Create a $roomReview variable containign the newly insert review data 
//Variable must use the name $roomReview in order to be used by review.php component
$roomReview = $review->getLastRoomReview($roomId);

include "../../components/review.php";
?>
