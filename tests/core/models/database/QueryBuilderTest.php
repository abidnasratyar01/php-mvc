<?php


use core\models\database\drivers\mysqli\queryBuilder;

 /**
  * This class tests queryBuilder class that is responsible to dynamically construct SQL querys for business logic
  */
class QueryBuilderTest extends PHPUnit\Framework\TestCase
{
    protected $QueryBuilderInstance;
    protected $MetadataInstance;

    /**
     * This Function sets class variables for all test cases
     *
     * @return void
     */
    public function setUp():void
    {
        $this->QueryBuilderInstance = new queryBuilder();
        $this->MetadataInstance = $this->createMock(CourseMetaData::class);
    }

    /**
     * This Function tests insertQuery method that is responsible to build SQL Insertion query for new record creation 
     */
    public function testInsertQuery()
    {
        $controller = 'course';
        $this->MetadataInstance->method('getParams')->willReturn([
            'name' => 'Data Structures',
            'dept' => 'CS'
        ]);

        $this->MetadataInstance->method($controller)->willReturn('Courses');

        $actualQuery = $this->QueryBuilderInstance->getInsertQuery($controller, $this->MetadataInstance);
        $expectQuery = "INSERT INTO `Courses` (`name`, `dept`) 
                VALUES ('Data Structures', 'CS') ";

        $this->assertEquals($expectQuery, $actualQuery);
    }

    /**
     * This Function tests insertQuery method's exception throw
     */
    public function testInsertQueryException()
    {
        $controller = 'course';
        $this->MetadataInstance->method('getParams')->willReturn([]);

        $this->MetadataInstance->method($controller)->willReturn('Courses');

        $this->expectExceptionMessage("Unable to Build Query, Possibly due to no data provided");
        $this->QueryBuilderInstance->getInsertQuery($controller, $this->MetadataInstance);
    }

    /**
     * This Function tests selectQuery method that is responsible to build SQL Select query for all record retrieval
     */
    public function testSelectQuery()
    {
        $controller = 'course';
        $this->MetadataInstance->method($controller)->willReturn('Courses');

        $actualQuery = $this->QueryBuilderInstance->getSelectQuery($controller, $this->MetadataInstance);
        $expectQuery = "SELECT * FROM `Courses`";

        $this->assertEquals($expectQuery, $actualQuery);
    }

    /**
     * This Function tests selectQuery method's Exception throw
     */
    public function testSelectQueryException()
    {
        $controller = '';

        $this->expectExceptionMessage("Unable to Build Query, Possibly due to no Controller provided");
        $this->QueryBuilderInstance->getSelectQuery($controller, $this->MetadataInstance);
    }

    /**
     * This Function tests deleteQuery method that is responsible to build SQL Deletion query for record deletion
     */
    public function testDeleteQuery()
    {
        $controller = 'course';
        $this->MetadataInstance->method('getId')->willReturn(1);

        $this->MetadataInstance->method($controller)->willReturn('Courses');

        $actualQuery = $this->QueryBuilderInstance->getDeleteQuery($controller, $this->MetadataInstance);
        $expectQuery = "DELETE FROM `Courses` WHERE 
                `Courses`.`id`=1";
        
        $this->assertEquals($expectQuery, $actualQuery);
    }

    /**
     * This Function tests deleteQuery method's Exception throw
     */
    public function testDeleteQueryException()
    {
        $controller = 'course';
        $this->MetadataInstance->method('getId')->willReturn('');

        $this->MetadataInstance->method($controller)->willReturn('Courses');

        $this->expectExceptionMessage("Unable to Build Query, Possibly due to no data provided");
        $this->QueryBuilderInstance->getDeleteQuery($controller, $this->MetadataInstance);
    }

    /**
     * This function tests updateQuery method that is responsible to build SQL Updation query to update record
     */
    public function testUpdateQuery()
    {
        $controller = 'course';
        $this->MetadataInstance->method('getParams')->willReturn([
            'name' => 'Data Structures',
            'dept' => 'CS'
        ]);

        $this->MetadataInstance->method($controller)->willReturn('Courses');
        $this->MetadataInstance->method('getId')->willReturn(1);

        $actualQuery = $this->QueryBuilderInstance->getUpdateQuery($controller, $this->MetadataInstance);
        $expectQuery = "UPDATE `Courses` SET `name` = 'Data Structures', `dept` = 'CS' WHERE 
            `Courses`.`id`=1";

        $this->assertEquals($expectQuery, $actualQuery);
    }

    /**
     * This function tests updateQuery method's Exception throw
     */
    public function testUpdateQueryException()
    {
        $controller = 'course';
        $this->MetadataInstance->method('getParams')->willReturn([]);

        $this->MetadataInstance->method($controller)->willReturn('Courses');
        $this->MetadataInstance->method('getId')->willReturn('');

        $this->expectExceptionMessage("Unable to Build Query, Possibly due to no data provided");
        $this->QueryBuilderInstance->getUpdateQuery($controller, $this->MetadataInstance);
    }
}