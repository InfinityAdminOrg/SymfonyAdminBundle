<?php

namespace Infinity\Navigation\Attribute;

#[\Attribute(\Attribute::TARGET_CLASS)]
class Group
{
    public function __construct(
        public string $id,
        public string $label,
        public string|null $icon = null
    ) {
    }
}
