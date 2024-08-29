<?php

namespace Infinity\Field\Event;

use Infinity\Field\Interface\FieldDescriberInterface;
use Infinity\Field\Interface\FieldInterface;
use Symfony\Contracts\EventDispatcher\Event;

class FieldHandleEvent extends Event
{
    private FieldInterface $field;

    public function __construct(
        private readonly FieldDescriberInterface $describer
    ) {
    }

    public function getDescriber(): FieldDescriberInterface
    {
        return $this->describer;
    }

    public function setField(
        FieldInterface $field
    ): void {
        $this->field = $field;
    }

    public function getField(): FieldInterface
    {
        return $this->field;
    }
}
