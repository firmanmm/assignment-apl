<?php

namespace Domain\Elearning\Entity;

use Exception;
use JsonSerializable;

class CourseEntity implements JsonSerializable{
    /**
     * Id
     *
     * @var int
     */
    private $id;
    /**
     * Course's id
     *
     * @var String
     */
    private $courseId;
    /**
     * Name
     *
     * @var String
     */
    private $name;
    /**
     * Description
     *
     * @var String
     */
    private $description;
    /**
     * Enrolled users
     *
     * @var String[]
     */
    private $users;
    /**
     * Capacity
     *
     * @var int
     */
    private $capacity;

    public function __construct(int $id = 0) {
        $this->id = $id;
        $this->users = [];
        $this->capacity = 0;
        $this->description = "";
        $this->name = "";
        $this->courseId = "";
    }

    public function setCourseId(String $courseId) : void {
        if(strlen($courseId) != 6) {
            throw new Exception("Course id's length is not equal with 6 current length : " . strlen($courseId)." value : ".$courseId);
        }
        $this->courseId = $courseId;
    }

    public function setName(String $name) : void {
        $this->name = $name;
    }

    public function setDescription(String $description) : void {
        $this->description = $description;
    }

    public function setCapacity(int $capacity) : void {
        $this->capacity = $capacity;
    }

    public function getId() : int {
        return $this->id;
    }
    
    public function getName() : String {
        return $this->name;
    }

    public function getDescription() : String {
        return $this->description;
    }

    public function getCapacity() : int {
        return $this->capacity;
    }

    public function getCourseId() : String {
        return $this->courseId;
    }

    /**
     * Return current user list
     *
     * @return array
     */
    public function getAllUser() : array {
        return $this->users;
    }

    /**
     * Enroll user to this course
     *
     * @param User $user
     * @return boolean Status
     */
    public function enroll(String $user) : bool {
        if($this->capacity <= count($this->users)){
            return false;
        }
        $this->users[] = $user;
        return true;
    }

    /**
     * Expel User from this course
     *
     * @param int $userId
     * @return void
     */
    public function expel(int $userId) : void {
        unset($this->users[$userId]);
    }

    /**
     * Check user existance
     *
     * @param integer $userId
     * @return boolean
     */
    public function isUserExist(int $userId) : bool {
        return isset($this->users[$userId]);
    }

    
    public function jsonSerialize()
    {
        $json = array();
        foreach($this as $key => $value) {
            $json[$key] = $value;
        }
        return $json;
    }
}