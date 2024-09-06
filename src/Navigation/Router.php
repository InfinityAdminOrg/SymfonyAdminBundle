<?php

namespace Infinity\Navigation;

use Infinity\Entity\Model\Resource;
use Infinity\Navigation\Attribute\Action;
use Symfony\Component\Routing\RouterInterface;

class Router
{
    public function __construct(
        private readonly RouterInterface $router
    ) {
    }

    /**
     * @param Action|null $action no action specified means the index action
     */
    public function generate(
        Resource $resource,
        Action|null $action = null
    ): string {
        return $this->router->generate('infinity.clear.opa', [
            'resourceId' => $resource->id,
            'action' => $action?->identifier ?? 'index',
        ]);
    }
}
