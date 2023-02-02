<?php

namespace Hotel;

use PDO;
use Hotel\BaseService;
use DateTime;

class Booking extends BaseService
{
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

}