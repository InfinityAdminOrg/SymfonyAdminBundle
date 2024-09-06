<?php

namespace Infinity\Context\Model;

use Infinity\Context\Interface\RoutingInterface;

class Route implements RoutingInterface
{
    public function __construct(
        private readonly string $resource,
        private readonly string $action
    ) {
    }

    public function getResource(): string
    {
        return $this->resource;
    }

    public function getAction(): string
    {
        return $this->action;
    }
}
