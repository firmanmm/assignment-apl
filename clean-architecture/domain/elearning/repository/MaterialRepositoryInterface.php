<?php

namespace Domain\Elearning\Repository;

interface MaterialRepositoryInterface extends RepositoryInterface {
    public function getByCourseId($id);
}