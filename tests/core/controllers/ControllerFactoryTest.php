<?php

require_once  ROOTDIR.'/app/controllers/courseController.php';

use core\controllers\controllerFactory;

/**
 * This Class tests ControllerFactory class that is responsible to create and return Instance of Controllers
 */
class ControllerFactoryTest extends PHPUnit\Framework\TestCase
{
    protected $controllerFactory;

    /**
     * This Function sets class variable controllerFactoryInstance for all test cases
     *
     * @return void
     */
    public function setUp():void
    {
        $this->controllerFactory = new controllerFactory();
    }

    /**
     * This function tests createController method of class controllerFactory that creates instance of Controller passed in parameter
     */
    public function testCreateController()
    {
        $expected = new courseController();

        $actual = $this->controllerFactory->createController('courseController');

        $this->assertEquals($expected, $actual);
    }

    /**
     * This function tests createController method's exception throw
     */
    public function testCreateControllerException()
    {
        $result = $this->controllerFactory->createController('UndefineController');
        preg_match_all('/\b\d{3}\b/', $result, $errorCode);

        $this->assertEquals(400, $errorCode[0][0]);
    }
}