<?php

namespace Infinity\Action\Service;

use Infinity\Action\Exception\InvalidExecutionException;
use Infinity\Action\Service\Listing as ActionListing;
use Infinity\Tool\Service\Listing as ToolListing;
use Symfony\Component\HttpFoundation\Request;

class Executor
{
    public function __construct(
        private readonly ToolListing $toolListing,
        private readonly ActionListing $actionListing
    ) {
    }

    /**
     * @throws InvalidExecutionException
     */
    public function __invoke(
        string $service,
        string $action,
        Request $request
    ): mixed {
        if (!$this->actionListing->isValidMethod($service, $action)) {
            throw new InvalidExecutionException($service, $action);
        }

        // todo: add permission checks for execution within the current context?
        return $this->toolListing->get($service)->{$action}($request);
    }
}
