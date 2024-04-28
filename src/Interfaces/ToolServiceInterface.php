<?php

namespace Infinity\Interfaces;

use Infinity\Exception\Tool\NotFoundException;
use Infinity\Interfaces\Tool\ToolInterface;

interface ToolServiceInterface
{
    /**
     * @throws NotFoundException
     */
    public function getTool(
        string $identifier
    ): ToolInterface;
}
