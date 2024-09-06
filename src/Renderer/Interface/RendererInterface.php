<?php

namespace Infinity\Renderer\Interface;

use Infinity\Context\Model\Context;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

interface RendererInterface
{
    public function render(
        Request $request,
        Context $context
    ): Response|null;
}
