<?php


namespace App\Exceptions;


use Throwable;

class InvalidBodyException extends \Exception
{
    private array $errors;

    public function __construct($message = ""|[], $code = 0, Throwable $previous = null)
    {
        if(is_array($message))
        {
            $this->errors = $message;
            $message = implode($message);
        }

        parent::__construct($message, $code, $previous);
    }

    public function getMessages(): array {
        return $this->errors;
    }
}
