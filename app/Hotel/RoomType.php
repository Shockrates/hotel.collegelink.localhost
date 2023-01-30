<?php

namespace Hotel;

use PDO;
use DateTime;
use Hotel\BaseService;

class RoomType extends BaseService
{
    public function getRoomTypes()
    {
        //Create SQL query  
        $sql = 'SELECT DISTINCT * FROM room_type';
        //Fetch SQL results
        $allRecords = $this->fetchAll($sql);

        return $allRecords;
    }

    public function getTypeTitle()
    {
        //Create SQL query  
        $sql = 'SELECT DISTINCT * FROM room_type';
        //Fetch SQL results
        $allRecords = $this->fetchAll($sql);

        return $allRecords;
    }
}