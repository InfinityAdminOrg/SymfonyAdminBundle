<?php

namespace Infinity\Navigation;

use Infinity\Navigation\Interface\GroupInterface;

abstract class AbstractGroup implements GroupInterface
{
    public function name(): string
    {
        return 'N/A';
    }

    public function icon(): string|null
    {
        return null;
    }
}
