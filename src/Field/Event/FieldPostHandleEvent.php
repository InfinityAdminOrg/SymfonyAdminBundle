<?php

namespace Infinity\Field\Event;

use Infinity\Field\Interface\FieldInterface;
use Symfony\Contracts\EventDispatcher\Event;

class FieldPostHandleEvent extends Event
{
    public function __construct(
        private readonly FieldInterface $field
    ) {
    }

    public function getField(): FieldInterface
    {
        return $this->field;
    }
}
