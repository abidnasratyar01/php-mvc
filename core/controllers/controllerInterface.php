<?php

namespace core\controllers;

/**
 * controllerInterface allows the class that implements this interface i.e BaseController in our case to enforce certain
 * mentioned Methods on an object of its Class that herits baseController. This interface Reveals baseControllers's 
 * programming interface without revealing its class.
 */
interface controllerInterface 
{
    public function callAction($controller, $action, $params);
    public function create($controller, $action, $params);
    public function delete($controller, $action, $params);
    public function update($controller, $action, $params);
    public function listdata($controller, $action);
    public function defaultView($controller, $action);
}