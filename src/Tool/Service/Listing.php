<?php

namespace Infinity\Tool\Service;

use Infinity\Tool\Exception\InvalidServiceException;
use Infinity\Tool\Model\Service;

class Listing
{
    /**
     * @param array<string, Service> $services
     */
    public function __construct(
        private readonly array $services
    ) {
    }

    /**
     * @throws InvalidServiceException
     */
    public function get(
        string $service
    ): Service {
        return $this->services[$service] ?? throw new InvalidServiceException($service);
    }

    /**
     * @return array<string, Service>
     */
    public function all(): array
    {
        return $this->services;
    }
}
