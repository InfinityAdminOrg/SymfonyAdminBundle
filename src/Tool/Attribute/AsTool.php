<?php

namespace Infinity\Tool\Attribute;

use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;

/**
 * Marks a specified class as a tool.
 *
 * The same effect can be achieved by tagging your service with "infinity.tool" tag.
 */
#[\Attribute(\Attribute::TARGET_CLASS)]
class AsTool extends AutoconfigureTag
{
    public function __construct()
    {
        parent::__construct('infinity.tool');
    }
}
