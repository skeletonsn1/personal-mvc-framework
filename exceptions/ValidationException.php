<?php

namespace app\exceptions;

use Throwable;

class ValidationException extends \Exception
{
    private $validationMessage = [];

    public function __construct($message = '', $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function setValidationMessage(array $message): void
    {
        $this->validationMessage = $message;
    }

    public function getValidationMessage(): array
    {
        return $this->validationMessage;
    }
}
