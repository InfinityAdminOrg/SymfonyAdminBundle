<?php

namespace Infinity\Navigation\Model;

readonly class Breadcrumb
{
    public function __construct(
        public string $label,
        public string|null $url = null,
        public string|null $icon = null
    ) {
    }
}
