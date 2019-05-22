<?php

namespace Domain\Elearning\Entity;

use Exception;
use JsonSerializable;
use Domain\Elearning\Exception\CourseFullException;

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
     * @var UserEntity[]
     */
    private $users;
    /**
     * Available MaterialEntity
     *
     * @var MaterialEntity[]
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

    public function setName(string $name) : void {
        $this->name = $name;
    }

    public function setDescription(string $description) : void {
        $this->description = $description;
    }

    public function setCapacity(int $capacity) : void {
        $this->capacity = $capacity;
    }
    
    public function getName() : string {
        return $this->name;
    }

    public function getDescription() : string {
        return $this->description;
    }

    public function getCapacity() : int {
        return $this->capacity;
    }

    public function getCourseId() : string {
        return $this->courseId;
    }

    /**
     * Return current user list
     *
     * @return UserEntity[]
     */
    public function getAllUser() : array {
        return $this->users;
    }

    /**
     * Enroll user to this course
     *
     * @param UserEntity $user
     * @return void
     */
    public function enroll(UserEntity $user) : void {
        if($this->capacity <= count($this->users)){
            throw new CourseFullException($this);
        }
        $this->users[$user->getId()] = $user;
    }

    /**
     * Expel User from this course
     *
     * @param UserEntity $user
     * @return void
     */
    public function expel(UserEntity $user) : void {
        unset($this->users[$user->getId()]);
    }

    /**
     * Check user existance
     *
     * @param UserEntity $user
     * @return boolean
     */
    public function isUserExist(UserEntity $user) : bool {
        return isset($this->users[$user->getId()]);
    }

    public function addMaterial(MaterialEntity $material) : void {
        $this->materials[$material->getId()] = $material;
    }

    public function removeMaterial(MaterialEntity $material) {
        unset($this->materials[$material->getId()]);
    }

    /**
     * Get available materials
     *
     * @return MaterialEntity[]
     */ 
    public function getMaterials() : array
    {
        return $this->materials;
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