<?php

namespace App\Elearning\Provider;

use Domain\Elearning\Provider\QRServiceInterface;
use chillerlan\QRCode\QRCode;

class QRServiceImpl implements QRServiceInterface {

    private $generator;

    public function __construct()
    {
        $this->generator = new QRCode();
    }

    public function generate(string $data): string
    {
        return $this->generator->render($data);
    }
}