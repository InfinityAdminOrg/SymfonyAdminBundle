<?php

namespace Infinity\Renderer;

use Infinity\Context\Model\Context;
use Twig\Environment;

class HtmxRenderer
{
    public function __construct(
        private readonly Environment $twig
    ) {
    }

    public function render(
        string $template,
        Context $context,
        array $variables = []
    ): string {
        $wrapper = $this->twig->load($template);

        return match ($context->isHtmx()) {
            false => $wrapper->render($variables),
            true => $wrapper->renderBlock('container', $variables),
        };
    }
}
