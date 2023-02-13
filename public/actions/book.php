<?php

use Hotel\User;
use Hotel\Booking;

//Boot application
require_once __DIR__.'/../../boot/boot.php';

$checkInDate = $_REQUEST['check_in_date']; 
$checkOutDate = $_REQUEST['check_out_date'];

//Check if room_id is given
$roomId = $_POST['room_id'];
if (empty($roomId)) {
    http_response_code(404);
    header('Location: /');

    return;
}

$url = sprintf('/room.php?room_id=%s&check_in_date=%s&check_out_date=%s',$roomId, $checkInDate, $checkOutDate);

//Return to Home page if not a POST request
if (strtolower($_SERVER['REQUEST_METHOD']) != 'post'){
    http_response_code(404);
    header('Location: /');
    return;
}


//If there is NO logged User return to main
if (empty(User::getCurrentUserId())) {
    http_response_code(404);
    header('Location: '.$url);
    return;
} 

//Verify csrf
$csrf = $_POST['csrf'];
if (empty($csrf) || !User::verifyCsrf($csrf)){
    http_response_code(404);
    header('Location: '.$url);
    return;
}


//Create booking
$booking = new Booking();

//Check if room is booked
$booked = $booking->isBooked($roomId, $checkInDate, $checkOutDate);
if ($booked) {
    http_response_code(404);
    header(sprintf('Location: /room.php?room_id=%s&check_in_date=%s&check_out_date=%s', $roomId, $checkInDate, $checkOutDate));
    return;
} 

$booking->insertBooking($roomId, User::getCurrentUserId(), $checkInDate, $checkOutDate);

header(sprintf('Location: /room.php?room_id=%s&check_in_date=%s&check_out_date=%s', $roomId, $checkInDate, $checkOutDate));
