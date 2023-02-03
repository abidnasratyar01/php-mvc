<?php 

namespace core;

/**
 * Request Class Uses Singleton Design pattern which restricts the instantiation of a class to one "single" instance, so, 
 * being the Entry point, Instance of request Class is Used to retrieve data like Controller, Action and Request Data body about client 
 * requests so it can be used to comply the request in downstream Component Classes.
 * 
 */

class request 
{
    use SingletonTrait;

    private $urlPath;
    private $params;
    private $action;
    private $controller;

    /**
     * Private Class constructor, so class instant can not be instantiated from outside except through its public method getInstance.
     */
    private final function __construct() 
    {
        $this->urlPath = $_SERVER['REQUEST_URI'] ?? '/';
        $this->setRequest();
    }

    /**
     * Public method provides the controller acquired from Client request URL to the Dispatcher Class which uses 
     * it to instantiate the controller instantance through controller factory.
     * 
     * @return string
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * Public method provides the action acquired from Client request URL to the Dispatcher Class which passes it to controller
     * 
     * @return string
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * Public method provides the Params acquired from Client request URL to the Dispatcher Class which passes it to controller
     * 
     * @return string
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * Private method used to set the values to the property variables of Class i.e controller, action and params. It is called
     * in the contructor of Class.
     *
     * @return void
     */
    private function setRequest()
    {
        $url = substr($this->urlPath, 1, strlen($this->urlPath));
        parse_str($url, $parsedStr);
        $this->controller = $parsedStr['controller'];
        $this->action = $parsedStr['action'];
        $this->params = $this->setParams();
    }
    
    /**
     * Private method used to fetch the contents of the Request Method Body and return the array containing the contents 
     * of the Request method body. It is called in the setRequest Private method of Class.
     *
     * @return array
     */
    private function setParams()
    {
        $body = [];
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            foreach($_GET as $key => $value) {
                $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            foreach($_POST as $key => $value) {
                $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
            
        }
        return $body;
    }
}
