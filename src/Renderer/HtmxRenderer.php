<?php

namespace Infinity\Renderer;

use Infinity\Context\Model\Context;
use Infinity\Renderer\Interface\PartialRendererInterface;
use Symfony\Component\HttpFoundation\Request;
use Twig\Environment;

class HtmxRenderer
{
    /**
     * @param iterable<PartialRendererInterface> $partials
     */
    public function __construct(
        private readonly iterable $partials,
        private readonly Environment $twig
    ) {
    }

    public function render(
        string $template,
        Request $request,
        Context $context,
        array $variables = []
    ): string {
        $wrapper = $this->twig->load($template);
        $partials = [];

        $variables['infinity_context'] = $context;

        if ($context->isHtmx()) {
            foreach ($this->partials as $partial) {
                if (null === ($content = $partial->render($request, $context))) {
                    continue;
                }

                $partials[] = $content;
            }
        }

        return match ($context->isHtmx()) {
            false => $wrapper->render($variables),
            true => implode('', $partials).$wrapper->renderBlock('container', $variables),
        };
    }
}
