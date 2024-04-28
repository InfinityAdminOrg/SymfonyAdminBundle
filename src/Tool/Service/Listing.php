<?php

namespace Infinity\Tool\Service;

use Infinity\Tool\Exception\InvalidServiceException;

class Listing
{
    /**
     * @param array<string, object> $services
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
    ): object {
        return $this->services[$service] ?? throw new InvalidServiceException($service);
    }
}
