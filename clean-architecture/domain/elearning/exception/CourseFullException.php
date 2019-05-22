<?php

namespace Domain\Elearning\Exception;

use Domain\Elearning\Entity\CourseEntity;

class CourseFullException extends \RuntimeException {
    public function __construct(CourseEntity $courseEntity)
    {
        parent::__construct($courseEntity->getId()."'s capacity is at limit [".$courseEntity->getId()."]");
    }
}