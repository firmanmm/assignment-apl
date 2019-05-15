<?php

namespace Domain\Elearning\Entity;

use Exception;
use JsonSerializable;

class CourseEntity extends AbstractEntity{
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
     * @var int[]
     */
    private $users;
    /**
     * Available materials
     *
     * @var int[]
     */
    private $materials;
    /**
     * Capacity
     *
     * @var int
     */
    private $capacity;

    public function __construct(int $id = 0) {
        parent::__construct($id);
        $this->setId($id);
        $this->materials = [];
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
        $ids = [];
        foreach($this->users as $key => $value){
            $ids[] = $key;
        }
        return $ids;
    }

    /**
     * Enroll user to this course
     *
     * @param integer $user
     * @return boolean Status
     */
    public function enroll(int $userId) : bool {
        if($this->capacity <= count($this->users)){
            return false;
        }
        $this->users[$userId] = $userId;
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

    public function addMaterial(int $materialId) {
        $this->materials[$materialId] = $materialId;
    }

    public function removeMaterial(int $materialId) {
        unset($this->materials[$materialId]);
    }

    /**
     * Get available materials
     *
     * @return  MaterialEntity
     */ 
    public function getMaterials()
    {
        return $this->materials;
    }

    /**
     * Set available materials
     *
     * @param  MaterialEntity  $materials  Available materials
     *
     * @return  self
     */ 
    public function setMaterials(MaterialEntity $materials)
    {
        $this->materials = $materials;

        return $this;
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