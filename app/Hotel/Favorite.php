<?php

namespace Hotel;

use PDO;
use Hotel\BaseService;

class Favorite extends BaseService
{
    public function isFavorite($roomId, $userId)
    {   
        //Create Parameters TABLE
        $parameters = [
            ':room_id' => $roomId,
            ':user_id' => $userId,
        ];
        //Create SQL query  
        $sql = 'SELECT * FROM favorite WHERE room_id = :room_id AND user_id = :user_id';
        //Fetch SQL results
        $isFavorite = $this->fetch($sql, $parameters);
        return  !empty($isFavorite);

    }

    public function setFavorite($roomId, $userId)
    {
          //Create Parameters TABLE
          $parameters = [
            ':userId' =>  $userId,
            ':roomId' => $roomId,  
        ];
        //Create SQL query  
        $sql = 'INSERT IGNORE INTO favorite (user_id, room_id) VALUES (:userId, :roomId)';

       $this->execute($sql, $parameters);
       
    }

    public function unSetFavorite($roomId, $userId)
    {
           //Create Parameters TABLE
           $parameters = [
            ':userId' =>  $userId,
            ':roomId' => $roomId,  
        ];
        //Create SQL query  
        $sql = 'DELETE FROM favorite WHERE user_id = :userId AND room_id = :roomId';

        $this->execute($sql, $parameters);
       
    }

    public function getListByUser($userId)
    {
        //Create Parameters TABLE
        $parameters = [
            ':user_id' => $userId,
        ];
        //Create SQL query  
        $sql = 'SELECT favorite.*, room.name FROM favorite INNER JOIN room ON favorite.room_id = room.room_id WHERE user_id = :user_id';
        //Fetch SQL results
        $allRecords = $this->fetchAll($sql, $parameters);
        
        return $allRecords;
    }
}