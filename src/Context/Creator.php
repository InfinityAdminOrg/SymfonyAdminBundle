<?php

namespace Infinity\Context;

use Infinity\Context\Interface\ResolverInterface;
use Infinity\Context\Model\Context;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class Creator
{
    /**
     * @param iterable<ResolverInterface> $resolvers
     */
    public function __construct(
        private readonly iterable $resolvers,
        private readonly TokenStorageInterface $tokenStorage
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
            $this->tokenStorage->getToken()?->getUser(),
            $request,
            $parts
        );
    }
}
