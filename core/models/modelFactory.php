<?php

namespace core\models;
use Exception;

/**
 * modelFactory class uses Factory method design pattern which is a creational design pattern used to create objects
 * of model without exposing the creation logic to the client and the client uses the same common interface to create 
 * a new type of model object. am
 *
 * @param $model Class Name
 * @return $model Instance
 */
class modelFactory
{

  /**
   * This static Function is responsible to create instance of Model passed in params to it and returns the instance.
   *
   * @param String $model
   * @return Instance
   */
  public static function createModel($model)
  {
    try {
        $filePath = ROOTDIR."/app/models/".$model.".php";
        
        if (!file_exists($filePath)) {
          throw new Exception("Unable to Complete Requested Action", 400);
        }
        
        require_once $filePath;

        if (!class_exists($model)) {
          // @codeCoverageIgnoreStart
          throw new Exception('Class Unfound, Unable to Create Object.', 404);
          // @codeCoverageIgnoreEnd
        }
        return new $model;

      } catch (Exception $e) {
        return 'Error: ' . $e->getCode(). ' ' . $e->getMessage();
    }
  }
}