<?php

use core\models\database\drivers\mysqli\Driver;
use core\models\database\drivers\mysqli\queryBuilder;

/**
 * This Class tests BaseModel class that is responsible for handling data and its related lgoic
 */
class BaseModelTest extends PHPUNIT\Framework\TestCase
{
    protected $modelInstance;
    protected $driverMock;

    /**
     * This Function sets class variables for all test cases
     *
     * @return void
     */
    public function setUp():void
    {
        $this->driverMock = $this->createMock(Driver::class);
        $this->driverMock->method('executeQuery')->willReturn(array());

        $this->modelInstance = $this->getMockBuilder(course::class)->setMethods(['getDriver'])->getMock();
        $this->modelInstance->method('getDriver')->willReturn($this->driverMock);
    }

    public function getParamValues($controller, $params):array
    {
        return array( 'controller'=>$controller, 'params'=>$params);
    }

    /**
     * This Function tests the addRecord method that is responsible to handle Record Addition
     */
    public function testAddRecord()
    {
        $paramValues = $this->getParamValues('course', ['name' => 'Data Structures','dept' => 'CS']);

        $actual = $this->modelInstance->addRecord($paramValues['controller'], $paramValues['params']);
        $expect = array();

        $this->assertEquals($actual, $expect);  
    }

    /**
     * This Function tests the getRecord method that is responsible to handle Records retrieval
     */
    public function testGetRecord()
    {
        $controller = 'course';

        $actual = $this->modelInstance->getRecord($controller);
        $expect = array();

        $this->assertEquals($actual, $expect);  
    }

    /**
     * This Function tests the deleteRecord method that is responsible to handle Record deletion
     */
    public function testDeleteRecord()
    {
        $paramValues = $this->getParamValues('course', ['id' => 1, 'name' => 'Data Structures', 'dept' => 'CS']);
        
        $actual = $this->modelInstance->deleteRecord($paramValues['controller'], $paramValues['params']);
        $expect = array();

        $this->assertEquals($actual, $expect);  
    }

    /**
     * This Function tests the updateRecord method that is responsible to handle record updation
     */
    public function testUpdateRecord()
    {
        $paramValues = $this->getParamValues('course', ['id' => 1, 'name' => 'Data Structures', 'dept' => 'CS']);

        $actual = $this->modelInstance->updateRecord($paramValues['controller'], $paramValues['params']);
        $expect = array();

        $this->assertEquals($actual, $expect);  
    }

    /**
     * This Function tests the getQueryBuilder that is responsible to create instance of QueryBuilder and return it
     */
    public function testGetQueryBuilder()
    {
        $actual = $this->modelInstance->getQueryBuilder();
        $expect = new queryBuilder();

        $this->assertEquals($actual, $expect);
    }

    /**
     * This Function tests the updateRecord method's Exception throw
     */
    public function testUpdateRecordException()
    {
        $paramValues = $this->getParamValues('', []);

        $result = $this->modelInstance->updateRecord($paramValues['controller'], $paramValues['params']);
        preg_match_all('/\b\d{3}\b/', $result, $errorCode);

        $this->assertEquals(400, $errorCode[0][0]); 
    }

    /**
     * This Function tests the addRecord method's Exception throw
     */
    public function testAddRecordException()
    {
        $paramValues = $this->getParamValues('', []);

        $result = $this->modelInstance->addRecord($paramValues['controller'], $paramValues['params']);
        preg_match_all('/\b\d{3}\b/', $result, $errorCode);

        $this->assertEquals(400, $errorCode[0][0]);
    }

    /**
     * This Function tests the getRecord method's Exception throw
     */
    public function testgetRecordException()
    {
        $controller = '';

        $result = $this->modelInstance->getRecord($controller);
        preg_match_all('/\b\d{3}\b/', $result, $errorCode);

        $this->assertEquals(400, $errorCode[0][0]);
    }

    /**
     * This Function tests the deleteRecord method's Exception throw
     */
    public function testDeleteRecordException()
    {
        $paramValues = $this->getParamValues('', []);

        $result = $this->modelInstance->deleteRecord($paramValues['controller'], $paramValues['params']);
        preg_match_all('/\b\d{3}\b/', $result, $errorCode);

        $this->assertEquals(400, $errorCode[0][0]);
    }
}