<?php

namespace Infinity\Context\Model;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\User\UserInterface;

class Context
{
    /**
     * @param list<object> $parts
     */
    public function __construct(
        private readonly UserInterface|null $user,
        private readonly Request $request,
        private readonly array $parts
    ) {
    }

    public function getUser(): UserInterface|null
    {
        return $this->user;
    }

    public function isHtmx(): bool
    {
        return 'true' === $this->request->headers->get('hx-request');
    }

    /**
     * @template T of object
     *
     * @param class-string<T> $target
     *
     * @return T|null
     */
    public function get(
        string $target
    ): object|null {
        foreach ($this->parts as $part) {
            if ($part instanceof $target) {
                return $part;
            }
        }

        return null;
    }
}
