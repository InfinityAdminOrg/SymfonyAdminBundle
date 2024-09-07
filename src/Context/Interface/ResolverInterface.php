<?php

namespace Infinity\Context\Interface;

use Symfony\Component\HttpFoundation\Request;

interface ResolverInterface
{
    public function resolve(
        Request $request
    ): object|null;
}
