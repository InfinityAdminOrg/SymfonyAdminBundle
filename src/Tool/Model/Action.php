<?php

namespace Infinity\Tool\Model;

use Symfony\Component\Translation\TranslatableMessage;

class Action
{
    public function __construct(
        private readonly string $method,
        private readonly TranslatableMessage $title,
        private readonly TranslatableMessage|null $description = null
    ) {
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getTitle(): TranslatableMessage
    {
        return $this->title;
    }

    public function getDescription(): TranslatableMessage|null
    {
        return $this->description;
    }
}
