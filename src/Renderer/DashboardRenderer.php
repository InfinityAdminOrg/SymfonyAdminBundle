<?php

namespace Infinity\Renderer;

use Infinity\Context\Model\Context;
use Infinity\Renderer\Interface\RendererInterface;
use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Dashboard renderer. Treated as fallback if needed.
 */
#[AsTaggedItem(priority: -1024)]
class DashboardRenderer implements RendererInterface
{
    public function __construct(
        private readonly HtmxRenderer $renderer
    ) {
    }

    public function render(
        Request $request,
        Context $context
    ): Response {
        return new Response(
            $this->renderer->render(
                '@InfinityBundle/base.html.twig',
                $context
            )
        );
    }
}
