<?php

namespace Infinity\Tool\Exception;

class InvalidServiceException extends \Exception
{
    public function __construct(
        private readonly string $service,
        string $message = '',
        int $code = 0,
        \Throwable|null $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }

    public function getService(): string
    {
        return $this->service;
    }
}
