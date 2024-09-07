<?php

namespace Infinity\Renderer;

use Infinity\Context\Model\Context;
use Infinity\Navigation\Model\Breadcrumb;
use Infinity\Navigation\Navigator;
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
        private readonly HtmxRenderer $renderer,
        private readonly Navigator $navigator
    ) {
    }

    public function render(
        Request $request,
        Context $context
    ): Response {
        $this->navigator->push(new Breadcrumb(
            'Dashboard'
        ));

        return new Response(
            $this->renderer->render(
                '@InfinityBundle/base.html.twig',
                $request,
                $context
            )
        );
    }
}
