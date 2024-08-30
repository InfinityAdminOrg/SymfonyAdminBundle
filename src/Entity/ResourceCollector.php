<?php

namespace Infinity\Entity;

use Infinity\Entity\Model\Resource;

class ResourceCollector
{
    /**
     * @param list<Resource> $resources
     */
    public function __construct(
        private readonly array $resources
    ) {
    }

    /**
     * @return list<Resource>
     */
    public function all(): array
    {
        return $this->resources;
    }
}
