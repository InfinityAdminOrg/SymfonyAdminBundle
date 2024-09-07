<?php

namespace Infinity\Renderer\Partial;

use Infinity\Context\Model\Context;
use Infinity\Navigation\Navigator;
use Infinity\Renderer\Interface\PartialRendererInterface;
use Symfony\Component\HttpFoundation\Request;

class TitleRenderer implements PartialRendererInterface
{
    public function __construct(
        private readonly Navigator $navigator
    ) {
    }

    public function render(
        Request $request,
        Context $context
    ): string|null {
        return '<title>'.$this->navigator->__toString().'</title>';
    }
}
