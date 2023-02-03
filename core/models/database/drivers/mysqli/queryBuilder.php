<?php

namespace core\models\database\drivers\mysqli;

use Exception;

/**
 * This Class is responsible to provide an interface which would abstract the dynamically construction SQL querys 
 * for business logics of model classes. But
 */
class queryBuilder 
{
    /**
     * Public Method that is responsible to build and return SQL Insertion query for new record creation of specified controller 
     * passed in the argument. It uses the metadata instace passed in the argument to get the required details. 
     *
     * @param String $controller
     * @param Object $metaData
     * @return String
     */
    public function getInsertQuery ($controller, $metaData)
    {
        $data = $metaData->getParams();

        if (!$data) throw new Exception("Unable to Build Query, Possibly due to no data provided");

        return "INSERT INTO `".$metaData->$controller()."` (`".implode("`, `", array_keys($data))."`) 
                VALUES ('".implode("', '", array_values($data))."') ";
    }

     /**
     * Public Method that is responsible to build and return SQL Reading query for all records of specified controller 
     * passed in the argument. It uses the metadata instace passed in the argument to get the required details. 
     *
     * @param String $controller
     * @return String
     */
    public function getSelectQuery ($controller, $metaData)
    {
        if (!$controller) throw new Exception("Unable to Build Query, Possibly due to no Controller provided");

        return "SELECT * FROM `".$metaData->$controller()."`";
    }

     /**
     * Public Method that is responsible to build and return SQL Deletion query for a record of specified controller 
     * passed in the argument. It uses the metadata instace passed in the argument to get the required details. 
     *
     * @param String $controller
     * @param Object $metaData
     * @return String
     */
    public function getDeleteQuery ($controller, $metaData)
    {
        if (!$metaData->getId()) throw new Exception("Unable to Build Query, Possibly due to no data provided");

        return "DELETE FROM `".$metaData->$controller()."` WHERE 
                `".$metaData->$controller()."`.`id`=".$metaData->getId()."";
    }

     /**
     * Public Method that is responsible to build and return SQL updation query for a record of specified controller 
     * passed in the argument. It uses the metadata instace passed in the argument to get the required details. 
     *
     * @param String $controller
     * @param Object $metaData
     * @return String
     */
    public function getUpdateQuery($controller, $metaData)
    {
        $record = $metaData->getParams();

        if (!$record || !$metaData->getId()) throw new Exception("Unable to Build Query, Possibly due to no data provided");

        return "UPDATE `" . $metaData->$controller() . "` SET ".implode(', ', array_map( function ($v, $k) 
        { 
            return sprintf("`%s` = '%s'", $k, $v); 
        }, $record, array_keys($record)))." WHERE 
            `".$metaData->$controller()."`.`id`=".$metaData->getId()."";
    }
} 