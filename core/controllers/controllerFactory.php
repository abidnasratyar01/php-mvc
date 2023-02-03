<?php

namespace core\controllers;
use Exception;
/**
 * controllerFactory class uses Factory method design pattern which is a creational design pattern used to create objects
 * of controller without exposing the creation logic to the client and the client uses the same common interface to create 
 * a new type of controller object.
 *
 * @param $controller Class Name
 * @return $Controller Instance
 */
class controllerFactory
{

  /**
   * This static Function is responsible to create instance of Controller passed in params to it and returns the instance.
   *
   * @param String $model
   * @return Instance
   */
  public static function createController($controller)
  {
    try {
        $filePath = ROOTDIR.'/app/controllers/' . $controller . '.php';
    
        if (!file_exists($filePath)) {
          throw new Exception('Unable to Complete Requested Action', 400);
        }
  
        require_once $filePath;

        if (!class_exists($controller)) {
            // @codeCoverageIgnoreStart
            throw new Exception('Class Unfound, Unable to Create Object.', 404);
            // @codeCoverageIgnoreEnd
        }
        return new $controller;

      } catch (Exception $e) {
        return 'Error: ' . $e->getCode(). ' ' . $e->getMessage();
      }
  }
}