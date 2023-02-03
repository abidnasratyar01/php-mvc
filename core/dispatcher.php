<?php 

namespace core;

use core\controllers\controllerFactory;
use Exception;

/**
 * Dispatcher Class is an ordinary class instantiated in Index and is Responsible instantiate controllers, pass on client request
 * to controller and execute the required actions on them. 
 *  
 */
class dispatcher 
{
    /**
     * Function Responsible to instantiate controllers, pass on client request to controller and execute the required 
     * actions on them and send back response to client/browser.
     *
     * @return mixed
     */
    public function dispatchRequest()
    {
        try {
            $request = request::getInstance();
            
            $params = $request->getParams();
            $controller = $request->getController();
            $action = $request->getAction();
    
            $controller = $controller ?? "default";
            
            $controllerInstance = controllerFactory::createController($controller."Controller");
            return $controllerInstance->callAction($controller, $action, $params);    
            
        } catch (Exception $e) {
            echo 'Error: ' . $e->getCode(). ' ' . $e->getMessage();
        }
    }
}