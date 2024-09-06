<?php

namespace Infinity\Context\Interface;

interface RoutingInterface extends ContextPartInterface
{
    public function getResource(): string;

    public function getAction(): string;
}
