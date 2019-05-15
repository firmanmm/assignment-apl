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

    public function __construct($id)
    {
        $this->id = $id;
    }
    
    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get time since this entity created
     *
     * @return  DateTime
     */ 
    public function getCreatedAt()
    {
        return $this->createdAt->format(DateTime::ATOM);
    }

    /**
     * Set time since this entity created
     *
     * @param  String  $createdAt  Time since this entity created
     *
     * @return  void
     */ 
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = new DateTime($createdAt);
    }

    /**
     * Get time since this entity is marked for deletion
     *
     * @return  DateTime
     */ 
    public function getDeletedAt()
    {
        return $this->deletedAt->format(DateTime::ATOM);
    }

    /**
     * Set time since this entity is marked for deletion
     *
     * @param  String  $deletedAt  Time since this entity is marked for deletion
     *
     * @return  self
     */ 
    public function setDeletedAt($deletedAt)
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