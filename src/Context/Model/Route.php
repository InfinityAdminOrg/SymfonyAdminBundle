<?php

namespace Infinity\Context\Model;

class Route
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
