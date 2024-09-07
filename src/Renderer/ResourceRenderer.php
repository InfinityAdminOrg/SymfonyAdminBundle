<?php

namespace Infinity\Renderer;

use Infinity\Context\Model\Context;
use Infinity\Context\Model\Route;
use Infinity\Entity\ResourceCollector;
use Infinity\Navigation\Model\Breadcrumb;
use Infinity\Navigation\Navigator;
use Infinity\Renderer\Interface\RendererInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;

class ResourceRenderer implements RendererInterface
{
    public function __construct(
        private readonly ResourceCollector $collector,
        private readonly HtmxRenderer $renderer,
        private readonly Navigator $navigator,
        private readonly RouterInterface $router
    ) {
    }

    public function render(
        Request $request,
        Context $context
    ): Response|null {
        if (null === ($router = $context->get(Route::class))) {
            return null;
        }

        if (null === ($resourceId = $router->getResource())) {
            return null;
        }

        $imploded = explode('\\', $resourceId);

        $this->navigator->push(new Breadcrumb(
            'Dashboard',
            $this->router->generate('infinity.opa')
        ))->push(new Breadcrumb(
            end($imploded)
        ));

        return new Response(
            $this->renderer->render(
                '@InfinityBundle/dynamic.html.twig',
                $request,
                $context,
                [
                    'infinity_variables' => [
                        'resourceId' => $resourceId,
                        'action' => $router->getAction(),
                    ],
                ],
            )
        );
    }
}
