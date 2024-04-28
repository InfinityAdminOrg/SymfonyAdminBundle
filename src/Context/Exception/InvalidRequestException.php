<?php

namespace Infinity\Context\Exception;

use Symfony\Component\HttpFoundation\Request;

class InvalidRequestException extends \Exception
{
    public function __construct(
        private readonly Request $request,
        string $message = '',
        int $code = 0,
        \Throwable|null $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }

    public function getRequest(): Request
    {
        return $this->request;
    }
}
