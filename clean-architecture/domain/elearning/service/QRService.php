<?php

namespace Domain\Elearning\Service;

use Domain\Elearning\Provider\QRServiceInterface;

class QRService {
    /**
     * QR Service Provider
     *
     * @var QRServiceInterface
     */
    private $provider;
    public function __construct(QRServiceInterface $qRServiceInterface)
    {
        $this->provider = $qRServiceInterface;
    }

    public function generateAsString(string $data) : string {
        return $this->provider->generate($data);
    }
}