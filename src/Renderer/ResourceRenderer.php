<?php

namespace Infinity\Renderer;

use Infinity\Context\Interface\RoutingInterface;
use Infinity\Context\Model\Context;
use Infinity\Entity\ResourceCollector;
use Infinity\Renderer\Interface\RendererInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ResourceRenderer implements RendererInterface
{
    public function __construct(
        private readonly ResourceCollector $collector,
        private readonly HtmxRenderer $renderer
    ) {
    }

    public function render(
        Request $request,
        Context $context
    ): Response|null {
        if (null === ($router = $context->get(RoutingInterface::class))) {
            return null;
        }

        if (null === ($resourceId = $router->getResource())) {
            return null;
        }

        return new Response(
            $this->renderer->render(
                '@InfinityBundle/dynamic.html.twig',
                $context,
                [
                    'infinity_context' => $context,
                    'infinity_variables' => [
                        'resourceId' => $resourceId,
                        'action' => $router->getAction(),
                    ],
                ],
            )
        );
    }
}
