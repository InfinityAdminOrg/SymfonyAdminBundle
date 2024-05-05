<?php

namespace Infinity\Tool\Model;

class Service
{
    /**
     * @param array<string, Action> $actions
     */
    public function __construct(
        private readonly object $service,
        private readonly string $id,
        private readonly array $actions,
    ) {
    }

    public function getService(): object
    {
        return $this->service;
    }

    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return array<string, Action>
     */
    public function getActions(): array
    {
        return $this->actions;
    }

    public function hasAction(
        string $action
    ): bool {
        return array_key_exists($action, $this->actions);
    }
}
