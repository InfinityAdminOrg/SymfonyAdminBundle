<?php

namespace Infinity\Shared\Attribute;

/**
 * Allows tightening access to resources or actions using default implementations.
 *
 * For additional details see: UNIMPLEMENTED.
 *
 * For resources, you may use the following string templates:
 * - `%action%` - an uppercased action name, snake case.
 */
#[\Attribute(\Attribute::TARGET_CLASS | \Attribute::TARGET_METHOD)]
readonly class WithRoles
{
    public function __construct(
        public array|string $roles
    ) {
    }
}
