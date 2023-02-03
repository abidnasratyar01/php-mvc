<?php

require_once  ROOTDIR.'/app/models/course.php';
use core\models\modelFactory;

/**
 * This Class tests the ModelFactory class that is responsible to create and return Instance of Model
 */
class ModelFactoryTest extends PHPUnit\Framework\TestCase
{
    protected $modelFactory;

    /**
     * This Function sets class variable controllerFactoryInstance for all test cases
     *
     * @return void
     */
    public function setUp():void
    {
        $this->modelFactory = new modelFactory();
    }

    /**
     * This function tests createModel method of class modelFactory that creates instance of Model passed in parameter
     */
    public function testCreateModel()
    { 
        $actual = $this->modelFactory->createModel('course');

        $expected = new course();
        
        $this->assertEquals($expected, $actual);
    }

    /**
     * This function tests createModel method's exception throw
     */
    public function testCreateModelException()
    { 
        $result = $this->modelFactory->createModel('developer');
        preg_match_all('/\b\d{3}\b/', $result, $errorCode);

        $this->assertEquals(400, $errorCode[0][0]);
    }
}