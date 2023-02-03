<?php

/**
 * This Class handles data about Courses and acts as metadata descriptor for ORM which is used to connect the object 
 * code to Database by providing the queryBuidler necessary data about Courses to build query which is at the end 
 * executed by Driver Class.
 */
class courseMetaData
{
    private $name;
    private $dept;
    private $id;
    
    /**
     * Public method that is responsible to set values to the Property variables of the this class that acts as a descriptor 
     * for the ORM. It is called from the model methods.
     *
     */
    public function setParams($data = [])
    {
        $this->id = $data['id'];
        $this->name = $data['name'];
        $this->dept = $data['dept'];
    }

    /**
     * Public method that is responsible to return the property variable of class except id in Associate Array. It is called 
     * from the queryBuilder's methods for construction of querys.
     *
     * @return Array
     */
    public function getParams()
    {
        return array('name'=>$this->name, 'dept' => $this->dept);
    }

    /**
     * Public method that is responsible to return the id property of class. It is called from the queryBuilder's methods for 
     * construction of querys.
     *
     * @return Integer
     */
    public function getId() 
    {
        return $this->id;
    }

    /**
     * Public method that is responsible to return Table Name of Courses in DB. It is called from the queryBuilder's methods for 
     * construction of querys.
     *
     * @return string
     */
    public function course() : string
    {
        return 'Courses';
    }
}