<?php

namespace core\models;

/**
 * modelInterface allows the class that implements this interface i.e BaseModel in our case to enforce certain
 * mentioned Methods on an object of its Class that herits baseModel. This interface Reveals baseModel's 
 * programming interface without revealing its class. here
 */
interface modelInterface
{
    public function addRecord($controller, $params);
    public function getRecord($controller);
    public function deleteRecord($controller, $params);
    public function updateRecord($controller, $params); 
}