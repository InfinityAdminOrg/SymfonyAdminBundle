<?php

namespace Infinity\Entity\Model;

use Infinity\Entity\Interface\ResourceInterface;
use Infinity\Navigation\Attribute\Action;
use Infinity\Navigation\Attribute\Group;

readonly class Resource
{
    /**
     * @param class-string $entity
     * @param list<Action> $actions
     */
    public function __construct(
        public ResourceInterface $resource,
        public string $entity,
        public string $id,
        public array $actions,
        public Group|null $group = null
    ) {
    }

    public function displayable(): bool
    {
        if (null === $this->group) {
            return false;
        }

        foreach ($this->actions as $action) {
            if ('index' === $action->identifier) {
                return true;
            }
        }

        return false;
    }
}
