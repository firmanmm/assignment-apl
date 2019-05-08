<?php

namespace Domain\Elearning\Entity;

use Exception;
use JsonSerializable;

class UserEntity implements JsonSerializable {
    /**
     * Id
     *
     * @var int
     */
    private $id;
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

    public function __construct(int $id = 0) {
        $this->id = $id;
        $this->studentId = "05111640000XXX";
        $this->name = "Students";
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

    public function getId() : int {
        return $this->id;
    }

    public function getName() : String {
        return $this->name;
    }

    public function getStudentId() : String {
        return $this->studentId;
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
