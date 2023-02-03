<?php

use core\views\ViewManager;

/**
 * This Class tests the ViewManager class that is resposible to return view to the client request
 */
class ViewManagerTest extends PHPUnit\Framework\TestCase
{
    private $viewManager;
    public function setUp():void
    {
        $this->viewManager = new ViewManager();
    }

    public function getParamValues($controller, $view, $data):array
    {
        return array( 'controller'=>$controller, 'view'=>$view, 'data'=>$data);
    }

    /**
     * This Function tests the renderView method that is responsible to return view specified in the Arguments to the client request
     */
    public function testRenderView()
    {
        $paramValues = $this->getParamValues('course', 'create', []);

        $actual = $this->viewManager->renderView($paramValues['controller'], $paramValues['view'], $paramValues['data']);
        $expect = require_once ROOTDIR.'/app/views/course/create.php';

        $this->assertEquals($actual, $expect);
    }

     /**
     * This Function tests the renderView method Exception
     */
    public function testRenderViewException()
    {
        $paramValues = $this->getParamValues('', '', []);

        $result = $this->viewManager->renderView($paramValues['controller'], $paramValues['view'], $paramValues['data']);
        preg_match_all('/\b\d{3}\b/', $result, $errorCode);

        $this->assertEquals(404, $errorCode[0][0]);
    }
}