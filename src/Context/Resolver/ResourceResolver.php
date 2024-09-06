<?php

namespace Infinity\Context\Resolver;

use Infinity\Context\Interface\ContextPartInterface;
use Infinity\Context\Interface\ResolverInterface;
use Infinity\Context\Model\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * @todo: validate against known resources
 */
class ResourceResolver implements ResolverInterface
{
    public function resolve(
        Request $request
    ): ContextPartInterface|null {
        if (null === ($resource = $request->query->get('resourceId'))) {
            return null;
        }

        return new Route(
            $resource,
            $request->query->get('action'),
        );
    }
}
