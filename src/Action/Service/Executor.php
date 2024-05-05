<?php

namespace Infinity\Action\Service;

use Infinity\Action\Exception\InvalidExecutionException;
use Infinity\Context\Model\Context;
use Infinity\Tool\Service\Listing;
use Symfony\Component\HttpFoundation\Request;

class Executor
{
    public function __construct(
        private readonly Listing $listing
    ) {
    }

    public function execute(
        Request $request,
        Context $context
    ): mixed {
        $service = $this->listing->get($context->getService());

        if (!$service->hasAction($context->getAction())) {
            throw new InvalidExecutionException(
                $context->getService(),
                $context->getAction()
            );
        }

        return $service->getService()->{$context->getAction()}($request);
    }
}
