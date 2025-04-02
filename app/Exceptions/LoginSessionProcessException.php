<?php

namespace App\Exceptions;

use Exception;

class LoginSessionProcessException extends Exception
{
    /**
     * Constructor with message
     *
     * @return LoginSessionProcessException
     */
    public static function withMessage()
    {
        $exception = app(LoginSessionProcessException::class);
        $exception->message = 'Failed to process login session.';
        $exception->code = '401';

        return $exception;
    }
}
