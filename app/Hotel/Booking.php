<?php

namespace Hotel;

use PDO;
use Hotel\BaseService;

class Booking extends BaseService
{
    public function isBooked($roomId, $fromDate, $toDate)
    {
        //Create Parameters TABLE
        $parameters = [
            ':room_id' => $roomId,
            ':checkInDate'=> $fromDate,
            ':checkOutDate' => $toDate,
        ];
        $sql = 'SELECT * FROM booking WHERE check_in_date <= :checkOutDate AND check_out_date >= :checkInDate AND room_id = :room_id';

        //Fetch SQL results
        $allRecords = $this->fetchAll($sql, $parameters);
        
        return $allRecords > 0;
    }
}