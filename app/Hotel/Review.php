<?php

namespace Hotel;

use PDO;
use Hotel\BaseService;

class Review extends BaseService
{
    public function insertReview($roomId, $userId, $userRate, $userComment)
    {
        //Start transaction
        $this->getPdo()->beginTransaction();

        //Create Parameters TABLE
        $parameters = [
            ':userId' =>  $userId,
            ':roomId' => $roomId, 
            ':userRate' =>  $userRate,
            ':userComment' => $userComment, 
        ];
        //Create SQL query  
        $sql = 'INSERT INTO review (user_id, room_id, rate, comment) VALUES (:userId, :roomId, :userRate, :userComment)';

        $this->execute($sql, $parameters);

        // Update average reviews
        $roomAverage = $this->getRoomAvgRate($roomId);
        
        $this->updateRoomAvg($roomId, $roomAverage['avg_reviews'], $roomAverage['count']);

        
        //Commit Transaction
        return $this->getPdo()->commit();
    }

    public function getReviewsByRoom($roomId)
    {
        //Create Parameters TABLE
        $parameters = [
            ':room_id' => $roomId,
        ];
        //Create SQL query  
        $sql = 'SELECT review.*, user.name as user_name  FROM review INNER JOIN user ON review.user_id = user.user_id WHERE room_id = :room_id ORDER BY created_time DESC';
        //Fetch SQL results
        $room = $this->fetchAll($sql, $parameters);
        return $room;
    }

    public function getReviewsByUser($userId)
    {
        //Create Parameters TABLE
        $parameters = [
            ':user_id' => $userId,
        ];
        //Create SQL query  
        $sql = 'SELECT review.*, room.name FROM review INNER JOIN room ON review.room_id = room.room_id WHERE user_id = :user_id';
        //Fetch SQL results
        $room = $this->fetchAll($sql, $parameters);
        return $room;
    }

    public function getRoomAvgRate($roomId)
    {
        //Create Parameters TABLE
        $parameters = [
            ':room_id' => $roomId,
        ];
            //Create SQL query  
            $sql = 'SELECT avg(rate) as avg_reviews, count(*) as count  FROM review WHERE room_id = :room_id';
            //Fetch SQL results
            $avg = $this->fetch($sql, $parameters);
            return $avg;
    }

    public function getLastRoomReview($roomId)
    {
        //Create Parameters TABLE
        $parameters = [
            ':room_id' => $roomId,
        ];
            //Create SQL query  
            // $sql = 'SELECT  review.*, user.name as user_name  FROM review INNER JOIN user ON review.user_id = user.user_id WHERE room_id = :room_id ORDER BY review_id DESC LIMIT 1';
            $sql = 'SELECT (SELECT COUNT(*) FROM review WHERE room_id = :room_id) as count, review.*, user.name as user_name  FROM review INNER JOIN user ON review.user_id = user.user_id WHERE room_id = :room_id ORDER BY review_id DESC LIMIT 1';
            //Fetch SQL results
            $last = $this->fetch($sql, $parameters);
            return $last;
    }

    public function updateRoomAvg($roomId, $avgReviews, $countReviews)
    {
       
        //Create Parameters TABLE
        $parameters = [
            ':room_id' => $roomId,
            ':avg_reviews' => $avgReviews,
            ':count_reviews' => $countReviews,
        ];
            //Create SQL query  
            $sql = 'UPDATE room SET avg_reviews = :avg_reviews, count_reviews = :count_reviews WHERE room_id = :room_id';
            //Fetch SQL results
            $this->execute($sql, $parameters);
           
    }
}