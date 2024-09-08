<?php

namespace Infinity\Field\Interface;

use Symfony\Component\Translation\TranslatableMessage;

/**
 * A basic field describer interface.
 *
 * Through this interface a field may be created which will then be later worked on by a {@link FieldHandlerInterface}.
 */
interface FieldDescriberInterface
{
    public function getLabel(): string|TranslatableMessage|false|null;

    public function getField(): string|null;
}
