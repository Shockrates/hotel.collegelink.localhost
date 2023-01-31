<?php

namespace Hotel;

use PDO;
use DateTime;
use Hotel\BaseService;

class Room extends BaseService
{
   
    public function get($roomId){
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
    public function getCities()
    {
        //Create SQL query  
        $sql = 'SELECT DISTINCT city FROM room';
        //Fetch SQL results
        $allRecords = $this->fetchAll($sql);

        //Get Cities
        $cities =[];
        foreach ($allRecords as $row) {
            $cities[] = $row['city'];
        }
        return $cities;
    }

    public function getCountOfGuests()
    {
        //Create SQL query  
        $sql = 'SELECT DISTINCT count_of_guests FROM room';
        //Fetch SQL results
        $allRecords = $this->fetchAll($sql);

        //Get Number of Guests
        $countOfGuests =[];
        foreach ($allRecords as $row) {
            $countOfGuests[] = $row['count_of_guests'];
        }
        return $countOfGuests;
    }
    
    public function getRoomTypes()
    {
        //Create SQL query  
        $sql = 'SELECT DISTINCT type.title FROM room, room_type AS type WHERE room.room_id = type.type_id';
        //Fetch SQL results
        $allRecords = $this->fetchAll($sql);

        //Get Room types
        $roomTypes =[];
        foreach ($allRecords as $row) {
            $roomTypes[] = $row['title'];
        }
        return $roomTypes;
    }

    public function searchRoom($checkInDate, $checkOutDate, $city = '', $typeId = '', $guests='', $minPrice='', $maxPrice='')
    {
       

        $checkInDate = (new DateTime($checkInDate))->format(DateTime::ATOM);
        $checkOutDate = (new DateTime($checkOutDate))->format(DateTime::ATOM);

        //Create Parameters TABLE
        $parameters = [
            ':checkInDate'=> $checkInDate,
            ':checkOutDate' => $checkOutDate,
        ];

        if (!empty($city)) {
            $parameters[':city'] = $city;
        } 
        if (!empty($typeId)) {
            $parameters[':type_id'] = $typeId;
        }
        if (!empty($guests)) {
            $parameters[':count_of_guests'] =$guests;
        }
        if (!empty($minPrice)) {
            $parameters[':minPrice'] = $minPrice;
        }
        if (!empty($maxPrice)) {
            $parameters[':maxPrice'] = $maxPrice;
        }
        
        //Create SQL query  
        $sql = 'SELECT * FROM room WHERE ';
        if (!empty($city)) {
            $sql .= 'city = :city AND ';
        }
        if (!empty($typeId)) {
            $sql .= 'type_id = :type_id AND ';
        }
        if (!empty($guests)) {
            $sql .= 'count_of_guests = :count_of_guests AND ';
        }

        if (!empty($minPrice)) {
            $sql .= 'price >= :minPrice AND ';
        }

        if (!empty($maxPrice)) {
            $sql .= 'price <= :maxPrice AND ';
        }
        
        $sql .= 'room_id NOT IN (
            SELECT room_id
            FROM booking
            WHERE check_in_date <= :checkOutDate AND check_out_date >= :checkInDate)';
        //Fetch SQL results
        $allRecords = $this->fetchAll($sql, $parameters);
        
        return $allRecords;

    }

    public function getMinaAndMaxPrice()
    {
        //Create SQL query  
        $sql = 'SELECT  MIN(price), MAX(price) FROM room';
        //Fetch SQL results
        $allRecords = $this->fetch($sql);
        //Get pirces types
        $prices =[];
        foreach ($allRecords as $row) {
            $prices[] = $row;
        }
        return $prices;
        
    }

    

   
}