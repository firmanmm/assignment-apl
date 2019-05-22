<?php

namespace Domain\Elearning\Exception;

class InvalidFormatException extends \RuntimeException {
    public function __construct(string $message = "")
    {
        parent::__construct("Current Format Is Invalid : ".$message);
    }
}