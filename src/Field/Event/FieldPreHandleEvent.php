<?php

namespace Infinity\Field\Event;

use Infinity\Field\Interface\FieldDescriberInterface;
use Symfony\Contracts\EventDispatcher\Event;

class FieldPreHandleEvent extends Event
{
    public function __construct(
        private FieldDescriberInterface $describer
    ) {
    }

    public function getDescriber(): FieldDescriberInterface
    {
        return $this->describer;
    }

    public function setDescriber(
        FieldDescriberInterface $describer
    ): void {
        $this->describer = $describer;
    }
}
