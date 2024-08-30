<?php

namespace Infinity\Navigation\Attribute;

use Infinity\Shared\Attribute\WithRoles;

#[\Attribute(\Attribute::TARGET_CLASS | \Attribute::TARGET_METHOD | \Attribute::IS_REPEATABLE)]
readonly class Action
{
    /**
     * @param list<string, Action>|null $excludeOn
     * @param list<string, Action>|null $displayOn
     */
    public function __construct(
        public string $identifier,
        public WithRoles|null $roles = null,
        public array|null $excludeOn = null,
        public array|null $displayOn = null
    ) {
    }
}
