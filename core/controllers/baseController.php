<?php 

namespace core\controllers;

use core\models\modelFactory;
use core\views\ViewManager;
use Exception;

/**
 * Being Parent Class which implements methods that holds basic functionalities that are used across multiple inherited controllers 
 * and these Functionalities are responsible to Controll the Clients Interaction with Controllers and its flow of data. 
 */
class baseController implements controllerInterface
{
    protected $viewManager;

    public function __construct(){
        $this->viewManager = new ViewManager();
    }

    /**
     * Public method to call the required action as acquired by the client and return its response. This method is called 
     * in dispatcher's dispatchRequest method.
     *
     * @param string $controller
     * @param string $action
     * @param Array $params
     * @return View
     */
    public function callAction($controller, $action = "", $params = [])
    {
        try {
            if ($action == "") $action = "defaultView";
            
            if (!method_exists($this, $action)) throw new Exception('Undefine Action Call', 400);
    
            return $this->$action($controller, $action, $params); 

        } catch (Exception $e) {
            return 'Error: ' . $e->getCode(). ' ' . $e->getMessage();
        }
    }

    /**
     * Public method that handles/controls the new record addition of specified controller to Database. It is called from the 
     * callAction method of this class. Upon Compeletion of task returns back the Response view to client/browser.
     *
     * @param string $controller
     * @param string $action
     * @param array $params
     * @return View
     */
    public function create($controller, $action, $params)
    {
        if ($params) {
            if(in_array("", array_values($params))) throw new Exception('All Fields shall be filled to Create Record', 406);

            $modelInstance = $this->getModel($controller);
            
            $modelInstance->addRecord($controller, $params);   
        }
        return $this->viewManager->renderView($controller, $action);
    }

    /**
     * Public method that handles/controls the record deletion of specified controller from Database. It is called from the 
     * callAction method of this class. Upon Compeletion of task returns back the Response view to client/browser.
     *
     * @param string $controller
     * @param string $action
     * @param array $params
     * @return View
     */
    public function delete($controller, $action, $params)
    {
        $modelInstance = $this->getModel($controller);

        if ($params) {
            if (!$params['id']) throw new Exception('Record ID Has to be provided to delete Record', 406);

            $modelInstance->deleteRecord($controller, $params);
        }

        $response = $modelInstance->getRecord($controller);
        return $this->viewManager->renderView($controller, $action, $response);
    }

    /**
     * Public method that handles/controls the record updation of specified controller to Database. It is called from the 
     * callAction method of this class. Upon Compeletion of task returns back the Response view to client/browser.
     *
     * @param string $controller
     * @param string $action
     * @return View
     */
    public function update($controller, $action, $params)
    {
        if (!$params['update']) {
            return $this->viewManager->renderView($controller, $action, $params);
        }

        if(in_array("", array_values($params))) throw new Exception('All Fields shall be filled to Update Record', 406);

        $modelInstance = $this->getModel($controller);
        $modelInstance->updateRecord($controller, $params);
        
        return $this->viewManager->renderView($controller, $action);
    }

    /**
     * Public method that handles/controls the records reading of specified controller from Database. It is called from the 
     * callAction method of this class. Upon Compeletion of task returns back the Response view to client/browser.
     *
     * @param string $controller
     * @param string $action
     * @return View
     */
    public function listdata($controller, $action)
    {
        if (!$controller) throw new Exception('Controller Not Set', 400);

        $modelInstance = $this->getModel($controller);
        $response = $modelInstance->getRecord($controller);
        return $this->viewManager->renderView($controller, $action, $response);
    }
    
    /**
     * Public method that handles/controls the default interaction of specified controllers. It is called from the 
     * callAction method of this class and return default view to Client/Browser.
     *
     * @param string $controller
     * @return View
     */
    public function defaultView($controller, $action)
    {
        return $this->viewManager->renderView($controller, $action);
    }

    /**
     * Public that create instance of model and return it through call the static method of modelFactory class.
     * @codeCoverageIgnore
     * @return Instance
     */
    public function getModel($controller)
    {
        return modelFactory::createModel($controller);
    }
}