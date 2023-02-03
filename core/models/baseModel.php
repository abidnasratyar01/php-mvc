<?php

namespace core\models;

use Exception;
use core\models\database\drivers\mysqli\Driver;
use core\models\database\drivers\mysqli\queryBuilder;

/**
 * Being Parent Class which implements methods that holds basic functionalities that are used across multiple inherited 
 * model classes. These Functionalities are responsible for handling data and its related logic. I
 */
class baseModel implements modelInterface
{
    /**
     * Public method that handles the record addition of specified model to Database through use of ORM using metadata 
     * Descriptor. It is called from the controller class add method. Upon Compeletion of task returns back the 
     * Response to the controller.
     *
     * @param String $controller
     * @return Array
     */
    public function addRecord($controller, $params)
    {
        try {
            if (!$params || !$controller) {
                throw new Exception('Issued Undefine Action or Empty Record', 400);
            }
    
            $metaDataInstance = $this->getMetaData($controller);
            $metaDataInstance->setParams($params);
            $query = $this->getQueryBuilder()->getInsertQuery($controller, $metaDataInstance);

            return $this->getDriver()->executeQuery($query); 

        } catch (Exception $e) {
            return 'Error: ' . $e->getCode(). ' ' . $e->getMessage();
        }
    }

    /**
     * Public method that handles the record reading of specified model from Database through use of ORM using metadata 
     * Descriptor. It is called from the controller class listdata method. Upon Compeletion of task returns back the 
     * Response to the controller.
     * 
     * @param String $controller
     * @return Array
     */
    public function getRecord($controller)
    {
        try {
            if (!$controller) {
                throw new Exception('Issued Undefine Action', 400);
            }
    
            $query = $this->getQueryBuilder()->getSelectQuery($controller, $this->getMetaData($controller));

            return $this->getDriver()->executeQuery($query); 

        } catch (Exception $e) {
            return 'Error: ' . $e->getCode(). ' ' . $e->getMessage();
        }
    }

    /**
     * Public method that handles the record deletion of specified model from Database through use of ORM using metadata 
     * Descriptor. It is called from the controller class delete method. Upon Compeletion of task returns back the 
     * Response to the controller.
     *
     * @param String $controller
     * @return Array
     */
    public function deleteRecord($controller, $params)
    {
        try {
            if (!$params || !$controller) {
                throw new Exception('Issued Undefine Action or No Record Id', 400);
            } 
    
            $metaDataInstance = $this->getMetaData($controller);
            $metaDataInstance->setParams($params);
            $query = $this->getQueryBuilder()->getDeleteQuery( $controller, $metaDataInstance);

            return $this->getDriver()->executeQuery($query);  

        } catch (Exception $e) {
            return 'Error: ' . $e->getCode(). ' ' . $e->getMessage();
        }
    }
    
    /**
     * Public method that handles the record updation of specified model to Database through use of ORM using metadata 
     * Descriptor. It is called from the controller class update method. Upon Compeletion of task returns back the 
     * Response to the controller.
     *
     * @param String $controller
     * @return Array
     */
    public function updateRecord($controller, $params)
    {
        try {
            if (!$params || !$controller){
                throw new Exception('Issued Undefine Action or Empty Record', 400);
            } 
    
            $metaDataInstance = $this->getMetaData($controller);
            $metaDataInstance->setParams($params);
            $query = $this->getQueryBuilder()->getUpdateQuery( $controller, $metaDataInstance);

            return $this->getDriver()->executeQuery($query); 

        } catch (Exception $e) {
            return 'Error: ' . $e->getCode(). ' ' . $e->getMessage();
        }
    }

    /**
     * Method that is responsible to get Driver Class Instance and return it to the method called from. It is only called from
     * the class methods.
     * 
     * @codeCoverageIgnore
     * @return Instance
     */
    public function getDriver()
    {
        return Driver::getInstance();
    }

    /**
     * Method that is responsible to create instance of QueryBuilder and return it to the method called from. It is only called 
     * from the class methods.
     *
     * @return Instance
     */
    public function getQueryBuilder()
    {
        return new queryBuilder();
    }

    /**
     * Method that is responsible to create instance of Metadata and return it to the method called from. It acts as metadata 
     * descriptor for the ORM that acts as a bridge between our object and Database. It is only called from the class methods.
     *
     * @param String $controller
     * @return Instance
     */
    public function getMetaData($controller)
    {
        $metaData = $controller . 'MetaData';
        require_once ROOTDIR . "/app/models/metadata/$metaData.php";
        return new $metaData;
    }
}