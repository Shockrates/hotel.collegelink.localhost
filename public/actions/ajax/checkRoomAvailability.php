<?php

use Hotel\User;
use Hotel\Booking;

//Boot application
require_once __DIR__.'/../../../boot/boot.php';


//Return to Home page if not a POST request
if (strtolower($_SERVER['REQUEST_METHOD']) != 'get'){
    echo json_encode(["err" => "This is a get script,"]);
    die;
}

//Check if room_id is given
$roomId = $_GET['room_id'];
if (empty($roomId)) {
    echo json_encode(["err" => "No room is given for this operation"]);
    die;
}

$booking = new Booking();
$result = $booking->isBooked($_GET['room_id'], $_REQUEST['check_in_date'], $_REQUEST['check_out_date']);
echo json_encode($result);