<?php

namespace Domain\Elearning\Entity;

use \DateTime;

abstract class AbstractEntity implements \JsonSerializable {

    private $id;
    /**
     * Time since this entity created
     *
     * @var DateTime
     */
    private $createdAt;
    /**
     * Time since this entity is marked for deletion
     *
     * @var DateTime
     */
    private $deletedAt;

    public function __construct($id = 0)
    {
        $this->id = $id;
    }
    
    /**
     * Get the value of id
     */ 
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return void
     */ 
    public function setId($id) : void
    {
        $this->id = $id;
    }

    /**
     * Get time since this entity created
     *
     * @return  DateTime
     */ 
    public function getCreatedAt() : DateTime
    {
        return $this->createdAt;
    }

    /**
     * Set time since this entity created
     *
     * @param  String  $createdAt  Time since this entity created
     *
     * @return  void
     */ 
    public function setCreatedAt(DateTime $createdAt) : void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * Get time since this entity is marked for deletion
     *
     * @return DateTime
     */ 
    public function getDeletedAt() : DateTime
    {
        return $this->deletedAt;
    }

    /**
     * Set time since this entity is marked for deletion
     *
     * @param  String  $deletedAt  Time since this entity is marked for deletion
     *
     * @return  void
     */ 
    public function setDeletedAt($deletedAt) : void
    {
        $this->deletedAt = new DateTime($deletedAt);
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