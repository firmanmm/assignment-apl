<?php

namespace Domain\Elearning\Entity;

class MaterialEntity extends AbstractEntity {

    /**
     * Material's title
     *
     * @var String
     */
    private $title;
    
    /**
     * Material's description
     *
     * @var String
     */
    private $description;

    /**
     * Course Id
     *
     * @var int
     */
    private $courseId;

    public function __construct($id)
    {
        parent::__construct($id);
    }

    /**
     * Get material's title
     *
     * @return  String
     */ 
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set material's title
     *
     * @param  String  $title  Material's title
     *
     * @return  self
     */ 
    public function setTitle(String $title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get material's description
     *
     * @return  String
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set material's description
     *
     * @param  String  $description  Material's description
     *
     * @return  self
     */ 
    public function setDescription(String $description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get course Id
     *
     * @return  int
     */ 
    public function getCourseId()
    {
        return $this->courseId;
    }

    /**
     * Set course Id
     *
     * @param  int  $courseId  Course Id
     *
     * @return  self
     */ 
    public function setCourseId(int $courseId)
    {
        $this->courseId = $courseId;

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