<?php

namespace Domain\Elearning\Exception;

class NotFoundException extends \RuntimeException {
    public function __construct(string $message = "")
    {
        parent::__construct("Requested resources couldn't be found : ".$message);
    }
}