<?php

namespace Infinity\Context\Model;

class Context
{
    public function __construct(
        private readonly string $service,
        private readonly string $action
    ) {
    }

    public function getService(): string
    {
        return $this->service;
    }

    public function getAction(): string
    {
        return $this->action;
    }
}
