<?php

namespace Infinity\Navigation\Interface;

interface GroupInterface
{
    public function name(): string;

    public function icon(): string|null;
}
