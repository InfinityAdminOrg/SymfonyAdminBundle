<?php

namespace Infinity\Context\Model;

use Infinity\Context\Interface\ContextPartInterface;
use Symfony\Component\HttpFoundation\Request;

class Context
{
    /**
     * @param list<ContextPartInterface> $parts
     */
    public function __construct(
        private readonly Request $request,
        private readonly array $parts
    ) {
    }

    public function isHtmx(): bool
    {
        return 'true' === $this->request->headers->get('hx-request');
    }

    /**
     * @template T of ContextPartInterface
     *
     * @param class-string<T> $target
     *
     * @return T|null
     */
    public function get(
        string $target
    ): ContextPartInterface|null {
        foreach ($this->parts as $part) {
            if ($part instanceof $target) {
                return $part;
            }
        }

        return null;
    }
}
