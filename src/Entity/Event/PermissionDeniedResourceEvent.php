<?php

namespace Infinity\Entity\Event;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Contracts\EventDispatcher\Event;

class PermissionDeniedResourceEvent extends Event
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
