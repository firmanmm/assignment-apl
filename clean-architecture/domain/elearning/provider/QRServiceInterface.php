<?php 

namespace Domain\Elearning\Provider;

interface QRServiceInterface {
    function generate(string $data) : string;
}