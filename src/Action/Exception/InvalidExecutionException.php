<?php

namespace Infinity\Action\Exception;

class InvalidExecutionException extends \Exception
{
    public function __construct(
        private readonly string $service,
        private readonly string $action,
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

    public function getAction(): string
    {
        return $this->action;
    }
}
