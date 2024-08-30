<?php

namespace Infinity\Renderer;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class HtmxRenderer
{
    public function __construct(
        private readonly Environment $twig
    ) {
    }

    public function render(
        Request $request
    ): Response {
        // process request

        $isHtmx = 'true' === $request->headers->get('hx-request');

        $wrapper = $this->twig->load('@InfinityBundle/'.($isHtmx ? 'dynamic' : 'base').'.html.twig');

        return new Response(
            match ($isHtmx) {
                false => $wrapper->render(),
                true => $wrapper->renderBlock('container'),
            }
        );
    }
}
