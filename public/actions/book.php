<?php

use Hotel\User;
use Hotel\Booking;

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

$checkInDate = $_REQUEST['check_in_date']; 
$checkOutDate = $_REQUEST['check_out_date']; 

//Create booking
$booking = new Booking();
$booking->insertBooking($roomId, User::getCurrentUserId(), $checkInDate, $checkOutDate);

header(sprintf('Location: /room/?room_id=%s&check_in_date=%s&check_out_date=%s', $roomId, $checkInDate, $checkOutDate));
