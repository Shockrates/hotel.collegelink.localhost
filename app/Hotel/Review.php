<?php

namespace Hotel;

use PDO;
use Hotel\BaseService;

class Review extends BaseService
{
    public function addReview()
    {

    }

    public function getReviewsByRoom($roomId)
    {
         //Create Parameters TABLE
         $parameters = [
        ':room_id' => $roomId,
        ];
        //Create SQL query  
        $sql = 'SELECT review.*, user.name as user_name  FROM review INNER JOIN user ON review.user_id = user.user_id WHERE room_id = :room_id';
        //Fetch SQL results
        $room = $this->fetchAll($sql, $parameters);
        return $room;
    }
}