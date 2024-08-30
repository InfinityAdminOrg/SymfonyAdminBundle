<?php

namespace Infinity\Navigation\Attribute;

use Infinity\Shared\Attribute\WithRoles;

#[\Attribute(\Attribute::TARGET_CLASS)]
readonly class Index extends Action
{
    /**
     * @param list<string, Action>|null $excludeOn
     * @param list<string, Action>|null $displayOn
     */
    public function __construct(
        WithRoles|null $roles = null,
        array|null $excludeOn = null,
        array|null $displayOn = null
    ) {
        parent::__construct('index', $roles, $excludeOn, $displayOn);
    }
}