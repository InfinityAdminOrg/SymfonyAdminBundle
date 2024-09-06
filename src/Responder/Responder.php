<?php

namespace Infinity\Responder;

use Infinity\Context\Creator;
use Infinity\Renderer\Interface\RendererInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Responder
{
    /**
     * @param iterable<RendererInterface> $renderers
     */
    public function __construct(
        private readonly iterable $renderers,
        private readonly Creator $creator
    ) {
    }

    public function responder(
        Request $request
    ): Response {
        $request->attributes->set(
            '_infinity_context',
            $context = $this->creator->create($request)
        );

        foreach ($this->renderers as $renderer) {
            if (null === ($response = $renderer->render($request, $context))) {
                continue;
            }

            return $response;
        }

        return new Response('Weird.');
    }
}
