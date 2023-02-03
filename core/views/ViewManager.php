<?php 

namespace core\views;

use Exception;

/**
 * This Class is responsible to produce and return a response View to the Client on browser by receiving data 
 * from the Controllers and packages it and presents it to the browser for display.
 */
class ViewManager
{

    /**
     * This Function returns the response view specified in the Arguments to the client request
     *
     * @param string $controller
     * @param string $action
     * @param Array $data
     * @return View
     */
    public function renderView($controller, $view, $data = [])
    {
        try {
            if (!$controller || !$view) {
                throw new Exception('Page Not Found', 404);
            }
            
            return require_once ROOTDIR . '/app/views/layout/main.php';

        } catch (Exception $e) {
            return 'Error: ' . $e->getCode(). ' ' . $e->getMessage();
        }
    }
}