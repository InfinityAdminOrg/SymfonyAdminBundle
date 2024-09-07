<?php

namespace Infinity\Renderer\Partial;

use Infinity\Context\Model\Context;
use Infinity\Renderer\Interface\PartialRendererInterface;
use Symfony\Component\HttpFoundation\Request;
use Twig\Environment;

class BreadcrumbRenderer implements PartialRendererInterface
{
    public function __construct(
        private readonly Environment $twig
    ) {
    }

    public function render(
        Request $request,
        Context $context
    ): string|null {
        $template = $this->twig->load('@InfinityBundle/htmx/breadcrumb.html.twig');

        return $template->renderBlock('breadcrumb');
    }
}
