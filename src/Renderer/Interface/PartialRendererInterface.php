<?php

namespace Infinity\Renderer\Interface;

use Infinity\Context\Model\Context;
use Symfony\Component\HttpFoundation\Request;

/**
 * Used only for HTMX requests.
 */
interface PartialRendererInterface
{
    public function render(
        Request $request,
        Context $context
    ): string|null;
}
