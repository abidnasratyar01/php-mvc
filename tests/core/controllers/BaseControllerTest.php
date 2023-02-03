<?php

require_once  ROOTDIR.'/app/models/course.php';

use core\controllers\baseController;

/**
 * This class tests BaseController class that is responsible to Controll the Clients Interaction with Controllers and its flow of data
 */
class BaseControllerTest extends \PHPUnit\Framework\TestCase
{
    protected $controllerInstance;
    protected $courseModel;

    /**
     * This Function sets class variables for all test cases
     *
     * @return void
     */
    public function setUp():void
    {
        $this->courseModel = $this->createMock(course::class);
        
        $this->controllerInstance = $this->getMockBuilder(baseController::class)->setMethods(['getModel'])->getMock();
        $this->controllerInstance->method('getModel')->willReturn($this->courseModel);
    }

    public function getParamValues($controller, $action, $params):array
    {
        return array( 'controller'=>$controller, 'action'=>$action, 'params'=>$params);
    }

    /**
     * This function tests callAction method that is responsible to resolve the clients requests upon its interaction with Controller
     */
    public function testCallAction()
    {
        $paramValues = $this->getParamValues('course', 'create', []);

        $actual = $this->controllerInstance->callAction($paramValues['controller'], $paramValues['action'], $paramValues['params']);
        $expect = require_once ROOTDIR."/app/views/course/create.php";
        
        $this->assertEquals($actual, $expect);    
    }
    
    /**
     * This function tests the callAction method's Exception throw
     */
    public function testCallActionException()
    {
        $paramValues = $this->getParamValues('course', 'undefine', []);

        $result = $this->controllerInstance->callAction($paramValues['controller'], $paramValues['action'], $paramValues['params']);
        preg_match_all('/\b\d{3}\b/', $result, $errorCode);

        $this->assertEquals(400, $errorCode[0][0]);   
    }
    
    /**
     * This function tests create method of class that is responsible to manage new Record
     */
    public function testCreateWithParams()
    {
        $paramValues = $this->getParamValues('course', 'create', ['name'=> 'sfdsf','dept' => 'ClsdfsS']);

        $this->courseModel->method('addRecord')->willReturn(array());

        $actual = $this->controllerInstance->create($paramValues['controller'], $paramValues['action'], $paramValues['params']);
        $expect = require_once ROOTDIR."/app/views/course/create.php";

        $this->assertEquals($actual, $expect);      
    }

    /**
     * This function tests create method's exception throw with Empty Associative array values of Params 
     */
    public function testCreateWithEmptyParamsValues()
    {
        $paramValues = $this->getParamValues('course', 'create', ['name'=> '','dept' => '']);

        $this->courseModel->method('addRecord')->willReturn(array());
        
        $this->expectExceptionMessage('All Fields shall be filled to Create Record');
        $this->controllerInstance->create($paramValues['controller'], $paramValues['action'], $paramValues['params']);
    }

    /**
     * This function tests delete method that is responsible to manage Record deletion
     */
    public function testDelete()
    {
        $paramValues = $this->getParamValues('course', 'delete', ['id' => 1,'name'=> 's','dept' => 'ClS']);

        $this->courseModel->method('deleteRecord')->willReturn($data = array());
        
        $actual = $this->controllerInstance->delete($paramValues['controller'], $paramValues['action'], $paramValues['params']);
        $expect = require_once ROOTDIR."/app/views/course/delete.php";
        $this->assertEquals($actual, $expect);
    }

    /**
     * This Function tests delete method with Empty Associative array Params 
     */
    public function testDeleteWithEmptyParams()
    {
        $paramValues = $this->getParamValues('course', 'delete', []);

        $this->courseModel->method('deleteRecord')->willReturn(array());

        $actual = $this->controllerInstance->delete($paramValues['controller'], $paramValues['action'], $paramValues['params']);
        $expect = require_once ROOTDIR."/app/views/course/delete.php";
        $this->assertEquals($actual, $expect);
    }

    /**
     * This function tests delete method's exception throw with No Id value provide in associative array Params
     */
    public function testDeleteWithParamsNoIdValue()
    {
        $paramValues = $this->getParamValues('course', 'delete', ['name'=> 's','dept' => 'ClS']);

        $this->courseModel->method('deleteRecord')->willReturn(array());
        
        $this->expectExceptionMessage('Record ID Has to be provided to delete Record');
        $this->controllerInstance->delete($paramValues['controller'], $paramValues['action'], $paramValues['params']);
    }

    /**
     * This function tests update method that is responsible to manage Record updatation
     */
    public function testUpdate()
    {
        $paramValues = $this->getParamValues('course', 'update', ['id' => 1,'name'=> 'DS','dept' => 'CS','update' => 'update']);

        $this->courseModel->method('updateRecord')->willReturn(array());

        $actual = $this->controllerInstance->update($paramValues['controller'], $paramValues['action'], $paramValues['params']);
        $expect = require_once ROOTDIR."/app/views/course/update.php";
        $this->assertEquals($actual, $expect);
    }

    /**
     * This Function tests update method with No update value provides in associative array Params
     */
    public function testUpdateWithParamsNoUpdate()
    {
        $paramValues = $this->getParamValues('course', 'update', ['id' => 1,'name'=> 'Data Structure','dept' => 'CS']);

        $actual = $this->controllerInstance->update($paramValues['controller'], $paramValues['action'], $paramValues['params']);

        $expect = require_once ROOTDIR."/app/views/course/update.php";
        $this->assertEquals($actual, $expect);
    }

    /**
     * This function tests update method's exception throw with empty values provided in associative array Params
     */
    public function testUpdateWithEmptyParams()
    {
        $paramValues = $this->getParamValues('course', 'update', ['id' => 1,'name'=> '','dept' => '','update' => 'update']);
        $this->expectExceptionMessage('All Fields shall be filled to Update Record');
        $this->controllerInstance->update($paramValues['controller'], $paramValues['action'], $paramValues['params']);
    }

    /**
     * This Function tests listdata method that is responsible to manage Record Reading
     */
    public function testListdata()
    {
        $paramValues = $this->getParamValues('course', 'listdata', []);

        $this->courseModel->method('getRecord')->willReturn($data = array());

        $actual = $this->controllerInstance->listdata($paramValues['controller'], $paramValues['action']);
        $expect = require_once ROOTDIR."/app/views/course/listdata.php";
        $this->assertEquals($actual, $expect);
    }

    /**
     * This Function tests listdata method's exception throw with no controller provided
     */
    public function testListdataException()
    {
        $paramValues = $this->getParamValues('', 'listdata', []);

        $this->expectExceptionMessage('Controller Not Set');
        $this->controllerInstance->listdata($paramValues['controller'], $paramValues['action']);
    }

    /**
     * This function tests defaultView method that is responsible to manage default interaction
     */
    public function testDefaultView()
    {
        $paramValues = $this->getParamValues('course', '', []);

        $actual = $this->controllerInstance->callAction($paramValues['controller'], $paramValues['action']);

        $expect = require_once ROOTDIR."/app/views/course/defaultView.php";
        $this->assertEquals($actual, $expect);
    }
}