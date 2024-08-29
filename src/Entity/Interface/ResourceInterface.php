<?php

namespace Infinity\Entity\Interface;

use Infinity\Field\Interface\FieldDescriberInterface;
use Infinity\Navigation\Interface\GroupInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * A single entity, displayable through the admin panel.
 */
interface ResourceInterface
{
    /**
     * Whether the resource should be displayed.
     */
    public function display(
        Request $request
    ): bool;

    public function group(): GroupInterface;

    /**
     * @return iterable<FieldDescriberInterface>
     */
    public function fields(): iterable;
}
