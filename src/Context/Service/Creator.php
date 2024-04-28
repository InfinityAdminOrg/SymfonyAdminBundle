<?php

namespace Infinity\Context\Service;

use Infinity\Context\Exception\InvalidRequestException;
use Infinity\Context\Model\Context;
use Symfony\Component\HttpFoundation\Request;

class Creator
{
    /**
     * @throws InvalidRequestException
     */
    public function __invoke(
        Request $request
    ): Context {
        // todo: maybe figure out a nicer way to store these consts?
        if (null === ($action = $request->query->get('inAction'))
            || null === ($service = $request->query->get('inService'))) {
            throw new InvalidRequestException($request);
        }

        return new Context($service, $action);
    }
}
