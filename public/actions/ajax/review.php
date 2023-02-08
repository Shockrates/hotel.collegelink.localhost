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

//Set counter
$counter = count($review->getReviewsByRoom($roomId));

//return to room page
//echo json_encode($review->getLastRoomReview($roomId));
$lastReview = $review->getLastRoomReview($roomId);

?>

<div class="room-user-review">
    <div class="user-rating">
        <p>
            <span><?=$counter?>.</span>
            <span><?=$lastReview['user_name']?></span>
        </p>
        <div>
            <ul class="star-reviews">
            <?php
                for ($i=1; $i <= 5; $i++) { 
                    if ($lastReview['rate'] >= $i){
            ?>  
            <li class="fa fa-star is-active"></li>
            <?php 
                    }else{
            ?>
                <li class="fa fa-star"></li>
            <?php     
                    }                       
                }
            ?>
            </ul>
        </div>
    </div>
    <div class="time-added"><p>Add time: <?=$lastReview['created_time']//echo date();?></p ></div>
        <div class="user-comment">
            <p><?=$lastReview['comment']?></p>
        </div> 
    </div>
</div<