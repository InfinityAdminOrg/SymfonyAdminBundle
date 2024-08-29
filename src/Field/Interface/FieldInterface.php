<?php

namespace Infinity\Field\Interface;

interface FieldInterface
{
    /**
     * Returns original described object.
     */
    public function describes(): FieldDescriberInterface;
}
