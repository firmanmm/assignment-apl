<?php

namespace Domain\Elearning\Entity;

use \Exception;
use Domain\Elearning\Exception\InvalidFormatException;

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

    /**
     * Courses
     *
     * @var CourseEntity[]
     */
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
            throw new InvalidFormatException("Student id's length is not equal with 14 current length : " . strlen($studentId));
        }
        $this->studentId = $studentId;
    }

    public function getName() : string {
        return $this->name;
    }

    public function getStudentId() : string {
        return $this->studentId;
    }

    public function getCourses() : array {
        return $this->courses; //TODO : If Error check here
    }

    public function addCourse(CourseEntity $course) : void {
        $this->courses[$course->getId()] = $course;
    }

    public function removeCourse(CourseEntity $course) : void {
        unset($this->courses[$course->getId()]);
    }

    /**
     * Get the value of password
     * 
     * @return string
     */ 
    public function getPassword() : string
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  void
     */ 
    public function setPassword($password) : void
    {
        $this->password = $password;
    }

    public function jsonSerialize()
    {
        $json = parent::jsonSerialize();
        $json["name"] = $this->getName();
        $json["studentId"] = $this->getStudentId();
        return $json;
    }
}
