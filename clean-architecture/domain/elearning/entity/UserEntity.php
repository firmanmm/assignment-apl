<?php

namespace Domain\Elearning\Entity;

use \Exception;

class UserEntity extends AbstractEntity{

    /**
     * Name
     *
     * @var String
     */
    private $name;
    /**
     * Student's id
     *
     * @var String
     */
    private $studentId;

    private $courses;

    private $password;

    public function __construct(int $id = 0) {
        parent::__construct($id);
        $this->studentId = "05111640000XXX";
        $this->name = "Students";
        $this->courses = [];
    }

    public function setName(String $name) : void {
        $this->name = $name;
    }

    /**
     * Set Student Id, Length must be equal to 14
     *
     * @param String $studentId
     * @return void
     */
    public function setStudentId(String $studentId) : void {
        if(strlen($studentId) != 14) {
            throw new Exception("Student id's length is not equal with 14 current length : " . count($studentId));
        }
        $this->studentId = $studentId;
    }

    public function getName() : String {
        return $this->name;
    }

    public function getStudentId() : String {
        return $this->studentId;
    }

    public function addCourse(int $courseId) {
        $this->courses[$courseId] = $courseId;
    }

    public function removeCourse(int $courseId) {
        $this->courses[$courseId] = $courseId;
    }

    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  void
     */ 
    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function jsonSerialize()
    {
        $json = parent::jsonSerialize();
        foreach($this as $key => $value) {
            $json[$key] = $value;
        }
        return $json;
    }
}
