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

    public function setFavorite()
    {

    }

    public function unSetFavorite()
    {
        
    }
}