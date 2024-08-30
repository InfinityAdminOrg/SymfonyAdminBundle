<?php

namespace Infinity\Entity\Attribute;

#[\Attribute(\Attribute::TARGET_CLASS)]
readonly class AsResource
{
    /**
     * @param class-string $entity
     */
    public function __construct(
        public string $entity
    ) {
    }
}
