<?php

/**
 * This Class handles data about Students and acts as metadata descriptor for ORM which is used to connect the object 
 * code to Database by providing the queryBuidler necessary data about Students to build query which is at the end 
 * executed by Driver Class.
 */
class studentMetaData
{
    private $id;
    private $first_name;
    private $last_name;
    private $father_name;
    private $dept;
    private $email;
    private $dob;
    private $pnumber;

    /**
     * Public method that is responsible to set values to the Property variables of the this class that acts as a descriptor 
     * for the ORM. It is called from the model methods.
     *
     */
    public function setParams($data = [])
    { 
        $this->id = $data['id'];
        $this->first_name = $data['first_name'];
        $this->last_name = $data['last_name'];
        $this->father_name = $data['father_name'];
        $this->dept = $data['dept'];
        $this->email = $data['email'];
        $this->dob = $data['dob'];
        $this->pnumber = $data['pnumber'];
    }

    /**
     * Public method that is responsible to return the property variable of class except id in Associate Array. It is called 
     * from the queryBuilder's methods for construction of querys.
     *
     * @return Array
     */
    public function getParams()
    {
        return array('first_name'=>$this->first_name, 'last_name' => $this->last_name, 'dept' => $this->dept, 
                'father_name' => $this->father_name, 'email' => $this->email, 'dob' => $this->dob, 
                'pnumber' => $this->pnumber);
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
     * Public method that is responsible to return Table Name of Students in DB. It is called from the queryBuilder's methods for 
     * construction of querys.
     *
     * @return string
     */
    public function student() : string
    {
        return 'Students';
    }
}