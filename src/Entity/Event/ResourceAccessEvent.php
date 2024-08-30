<?php

namespace Infinity\Entity\Event;

use Symfony\Component\Security\Core\User\UserInterface;

class ResourceAccessEvent
{
    public function __construct(
        private readonly mixed $resource,
        private readonly UserInterface|null $user
    ) {
    }

    public function getResource(): mixed
    {
        return $this->resource;
    }

    public function getUser(): UserInterface|null
    {
        return $this->user;
    }
}
