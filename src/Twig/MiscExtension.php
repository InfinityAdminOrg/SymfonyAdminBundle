<?php

namespace Infinity\Twig;

use Infinity\Entity\ResourceCollector;
use Infinity\Navigation\Navigator;
use Infinity\Navigation\Router;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class MiscExtension extends AbstractExtension
{
    public function __construct(
        private readonly ResourceCollector $collector,
        private readonly Router $router,
        private readonly Navigator $navigator
    ) {
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('infinity_resource', fn () => $this->collector),
            new TwigFunction('infinity_router', fn () => $this->router),
            new TwigFunction('infinity_navigator', fn () => $this->navigator),
        ];
    }
}
