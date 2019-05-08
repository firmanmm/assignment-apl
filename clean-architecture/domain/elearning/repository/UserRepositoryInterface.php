<?php

namespace Domain\Elearning\Repository;

use Domain\Elearning\Repository\RepositoryInterface;

interface UserRepositoryInterface extends RepositoryInterface{
    function getByStudentId(String $studentId);
}