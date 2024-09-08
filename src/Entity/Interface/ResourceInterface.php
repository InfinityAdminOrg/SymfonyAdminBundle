<?php

namespace Infinity\Entity\Interface;

use Infinity\Field\Interface\FieldDescriberInterface;
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

    /**
     * @return iterable<FieldDescriberInterface>
     */
    public function describers(): iterable;
}
