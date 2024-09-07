<?php

namespace Infinity\Navigation;

use Infinity\Navigation\Model\Breadcrumb;

class Navigator implements \Stringable
{
    /**
     * @var list<Breadcrumb>
     */
    private array $crumbs = [];

    /**
     * @return list<Breadcrumb>
     */
    public function get(): array
    {
        return $this->crumbs;
    }

    public function push(
        Breadcrumb $breadcrumb
    ): static {
        $this->crumbs[] = $breadcrumb;

        return $this;
    }

    public function __toString(): string
    {
        return implode(' < ', array_map(
            fn (Breadcrumb $b) => $b->label,
            array_reverse($this->crumbs)
        ));
    }
}
