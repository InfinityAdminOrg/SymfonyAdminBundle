<?php

namespace Infinity\Field\Interface;

interface FieldHandlerInterface
{
    public function handle(
        FieldDescriberInterface $describer
    ): FieldInterface;
}
