<?php

namespace core\models\database\drivers\mysqli;

use core\SingletonTrait;
use Exception;

/**
 * Driver Class Uses Singleton Design pattern which restricts the instantiation of a class to one "single" instance. This 
 * Class is responsible to Execute the Query and Return Response back.
 */
class Driver
{
    use SingletonTrait;
    private $dbConn;

   /**
     * Private Class constructor, so class instant can not be instantiated from outside except through its public method getInstance.
     */
    private final function __construct()
    {
        try {
            $this->dbConn = mysqli_connect(HOST, USERNAME, PASSWORD, DBNAME);

            if(!$this->dbConn){
                throw new Exception("Connection failed: " . mysqli_connect_error());
            }
            
        } catch (Exception $e) {
            die ($e->getMessage());
        }
    }

    /**
     * Method that is responsible to execute query built by queryBuilder and passed in the arguments of this method 
     * and return query response. It is called from the model class methods 
     *
     * @param String $query
     * @return Array
     */
    public function executeQuery($query)
    {
        try {
            $result = $this->dbConn->query($query);

            if ($result === false){
                throw new Exception("Failed to perform act: " . $this->dbConn->error);
            }
            if ($result->num_rows > 0) {
                while ( $row = $result->fetch_assoc()) {
                    $data[] = $row;
                }
            }
            return $data;

        } catch (Exception $e) {
            die ($e->getMessage());
        }     
    }
}