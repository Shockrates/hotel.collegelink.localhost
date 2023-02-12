<?php

namespace Hotel;

use Hotel\BaseService;
use PDO;

class User extends BaseService
{
    

    // Signing key
    const TOKEN_KEY = 'asfdhkgjlr;ofijhgbfdklfsadf';

    private static $curentUserId;

    public function getUserList(){
       
        //Create SQL query  
        $sql = 'SELECT * FROM user';
        //Fetch SQL results
        $userList = $this->fetchAll($sql);
        return $userList;
    }

    public function getById($userId)
    {
        //Create Parameters TABLE
        $parameters = [
            ':user_id' => $userId,
        ];
        //Create SQL query  
        $sql = 'SELECT * FROM user WHERE user_id = :user_id';
        //Fetch SQL results
        $user = $this->fetch($sql, $parameters);
        return $user;
    }

    public function getByEmail($email)
    {
        //Create Parameters TABLE
        $parameters = [
            ':email' => $email,
        ];
        //Create SQL query  
        $sql = 'SELECT * FROM user WHERE email = :email';
        //Fetch SQL results
        $user = $this->fetch($sql, $parameters);
        return $user;
    }

   
    public function insertUser($name, $email, $password){

        // //Hash PAssword
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);

        //Create Parameters TABLE
        $parameters = [
            ':password' =>  $passwordHash,
            ':name' => $name,
            ':email' => $email,
            
        ];
        //Create SQL query  
        $sql = 'INSERT INTO user (name, email, password) VALUES (:name, :email, :password)';

        $rows = $this->fetch($sql, $parameters);
        // Check if the record has been inserted
        return $rows == 1;
    }


    public function verifyUser($email, $password)
    {
        // Retrieve User
        $user = $this->getByEmail($email);
        // Verify Password
        $verified = password_verify($password, $user['password']);

        return $verified;
    }

    //Generrate TOken function, maybe make another class for it?
    public function generateToken($userId, $csrf = '')
    {
        // Create token payload
        $payload = [
            'user_id' => $userId,
            'csrf' => $csrf ?: md5(time()),
        ];
        $payloadEncoded = base64_encode(json_encode($payload));
        $signature = hash_hmac('sha256', $payloadEncoded, self::TOKEN_KEY);

        return sprintf('%s.%s', $payloadEncoded, $signature);
    }

    public static function getTokenPayload($token)
    {
        // Get payload and signature
        [$payloadEncoded] = explode('.', $token);

        // Get payload
        return json_decode(base64_decode($payloadEncoded), true);
    }
    
    //Verify TOken function, maybe make another class for it?
    public function verifyToken($token)
    {
        // Get payload
        $payload = $this->getTokenPayload($token);
        $userId = $payload['user_id'];
        $csrf = $payload['csrf'];

        // Generate signature and verify
        return $this->generateToken($userId, $csrf) == $token;
    }

    public static function verifyCsrf($csrf)
    {
    
        return self::getCsrf() == $csrf;
    }

    public static function getCsrf()
    {
        $token = $_COOKIE['user_token'];
        // Get payload
        $payload = self::getTokenPayload($token);
        
        return $payload['csrf'];

    }
    public static function setCurrentUserId($userId)
    {
       self::$curentUserId = $userId;
    }

    public static function getCurrentUserId()
    {
        return self::$curentUserId;
    }
}


