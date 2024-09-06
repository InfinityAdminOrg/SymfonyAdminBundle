<?php

namespace Infinity\Context;

use Infinity\Context\Interface\ResolverInterface;
use Infinity\Context\Model\Context;
use Symfony\Component\HttpFoundation\Request;

class Creator
{
    /**
     * @param iterable<ResolverInterface> $resolvers
     */
    public function __construct(
        private readonly iterable $resolvers
    ) {
    }

    public function create(
        Request $request
    ): Context {
        $parts = [];

        foreach ($this->resolvers as $resolver) {
            $parts[] = $resolver->resolve($request);
        }

        return new Context(
            $request,
            $parts
        );
    }
}
