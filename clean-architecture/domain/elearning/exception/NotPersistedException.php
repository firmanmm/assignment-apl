<?php

namespace Domain\Elearning\Exception;

class NotPersistedException extends \RuntimeException {
    public function __construct(string $message = "")
    {
        parent::__construct("Trying to persist an object that depend on non persisted object : ".$message);
    }
}