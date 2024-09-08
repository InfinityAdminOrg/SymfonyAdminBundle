<?php

namespace Infinity\Field\Trait;

use Symfony\Component\Translation\TranslatableMessage;

trait FieldDescriberTrait
{
    private string|TranslatableMessage|false|null $label = null;
    private string|null $field = null;

    public function getLabel(): TranslatableMessage|string|false|null
    {
        return $this->label;
    }

    public function setLabel(
        TranslatableMessage|string|false|null $label
    ): static {
        $this->label = $label;

        return $this;
    }

    public function getField(): string|null
    {
        return $this->field;
    }

    public function setField(
        string|null $field
    ): static {
        $this->field = $field;

        return $this;
    }
}
