<?php

namespace Infinity;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class InfinityBundle extends Bundle
{
    public function build(
        ContainerBuilder $container
    ): void {
    }

    public function getPath(): string
    {
        if (null === $this->path) {
            $reflected = new \ReflectionObject($this);
            /** @var string $filename */
            $filename = $reflected->getFileName();
            $this->path = \dirname($filename, 2); // modern bundle type
        }

        return $this->path;
    }
}
