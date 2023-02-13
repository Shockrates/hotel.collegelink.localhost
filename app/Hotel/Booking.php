<?php

namespace Hotel;

use PDO;
use Hotel\BaseService;
use DateTime;

class Booking extends BaseService
{
    /**
     * Returns true if there is a booking for room roomId in given dates fromDate to toDate
     */
    public function isBooked($roomId, $fromDate, $toDate)
    {
        //Create Parameters TABLE
        $parameters = [
            ':room_id' => $roomId,
            ':checkInDate'=> (new DateTime($fromDate))->format(DateTime::ATOM),
            ':checkOutDate' => (new DateTime($toDate))->format(DateTime::ATOM),
        ];
        $sql = 'SELECT * FROM booking WHERE check_in_date <= :checkOutDate AND check_out_date >= :checkInDate AND room_id = :room_id';

        //Fetch SQL results
        $allRecords = $this->fetchAll($sql, $parameters);
        
        return count($allRecords) > 0;
    }

    /**
     * Creates a boooking for user userID for room roomId for given dates fromDate to toDate
     */
    public function insertBooking($roomId, $userId, $checkInDate, $checkOutDate)
    {

        //Start transaction
        $this->getPdo()->beginTransaction();

        //Get Room info
        $roomInfo = $this->getRoomInfo($roomId);
        $roomPrice = $roomInfo['price'];

        //Find final price
        $checkInDateTime = new DateTime($checkInDate);
        
        $checkOutDateTime = new DateTime($checkOutDate);
        
        $totalDays = $checkOutDateTime->diff($checkInDateTime)->days;
        $totalPrice = $roomPrice * $totalDays;

        //Create Parameters TABLE
        $parameters = [
            ':userId' =>  $userId,
            ':roomId' => $roomId, 
            ':check_in_date' =>  (new DateTime($checkInDate))->format(DateTime::ATOM),
            ':check_out_date' =>  (new DateTime($checkOutDate))->format(DateTime::ATOM), 
            ':total_price' => $totalPrice
        ];
        // var_dump($parameters);die;
        //Create SQL query  
        $sql = 'INSERT INTO booking (user_id, room_id, check_in_date, check_out_date, total_price) VALUES (:userId, :roomId, :check_in_date, :check_out_date, :total_price)';

        $this->execute($sql, $parameters);

        //Commit Transaction
        return $this->getPdo()->commit();
    }


    public function getRoomInfo($roomId)
    {
        //Create Parameters TABLE
        $parameters = [
            ':room_id' => $roomId,
            ];
        //Create SQL query  
        $sql = 'SELECT * FROM room WHERE room_id = :room_id';
        //Fetch SQL results
        $room = $this->fetch($sql, $parameters);
        return $room;
    }

    /**
     * Returns all bookings nmade by user
     */
    public function getBookingsByUser($userId)
    {
        //Create Parameters TABLE
        $parameters = [
            ':user_id' => $userId,
        ];
        //Create SQL query  
        $sql = 'SELECT booking.*, room.*, room_type.title AS room_type FROM booking INNER JOIN room ON booking.room_id = room.room_id INNER JOIN room_type ON room.type_id = room_type.type_id WHERE user_id = :user_id';
        //Fetch SQL results
        $room = $this->fetchAll($sql, $parameters);
        return $room;
    }



}