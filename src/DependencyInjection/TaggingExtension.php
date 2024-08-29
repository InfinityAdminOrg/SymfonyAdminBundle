<?php

namespace Infinity\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;

class TaggingExtension extends Extension
{
    /**
     * @param array<string, string> $map
     */
    public function __construct(
        private readonly array $map
    ) {
    }

    public function load(
        array $configs,
        ContainerBuilder $container
    ): void {
        foreach ($this->map as $interface => $tag) {
            $container->registerForAutoconfiguration($interface)
                ->addTag($tag);
        }
    }
}
