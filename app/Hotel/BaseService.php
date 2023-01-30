<?php

namespace Hotel;

use PDO;
use Support\Config\Configuration;

class BaseService
{
    private static $pdo;

    public function __construct(){
        $this->initilizePdo();
    }

    protected function initilizePdo(){

        //Check if PDO is Initilized
        if (!empty(self::$pdo)) {
            return;
        }
        //Load database Configuration
        $config = Configuration::getInstance();
        $db = $config->getConfig()['database'];
        
        // Initialize a PDO connection to database
        try {
            self::$pdo = new PDO(sprintf('mysql:host=%s;dbname=%s;charset=UTF8', $db['host'], $db['dbname']), $db['username'], $db['password'], [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"]);
        } catch (\PDOException $ex) {
            throw new \Exception(sprintf('Could not connect to database: %s with User:%s. Error: %s',$db['dbname'], $db['username'], $ex->getMessage()));
        }
      
    }

    protected function fetchAll($sql, $parameters = [], $type = PDO::FETCH_ASSOC)
    {
        // Prepare statement
        $statement = $this->getPdo()->prepare($sql);

        //Bind parameters
        foreach ($parameters as $key => $value) {
            $statement->bindValue($key, $value, is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR);
        }
  
        // Execute statement
        $status = $statement->execute();
        if (!$status) {
            throw new \Exception($statement->erroInfo()[2]);
         }
        
        // Fetch results
        $allRecords = $statement->fetchAll($type);

        return $allRecords;
    }

    protected function fetch($sql, $parameters = [], $type = PDO::FETCH_ASSOC)
    {
        // Prepare statement
        $statement = $this->getPdo()->prepare($sql);

        //Bind parameters
        foreach ($parameters as $key => $value) {
            
            $statement->bindValue($key, $value, is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR);
        }
        
        // Execute statement
        $status = $statement->execute();
        if (!$status) {
            throw new \Exception($statement->erroInfo()[2]);
         }
        // Fetch results
        $record = $statement->fetch($type);

        return $record;
    }

    //Get PDO 
    protected function getPdo(){
        return self::$pdo;
    }


}