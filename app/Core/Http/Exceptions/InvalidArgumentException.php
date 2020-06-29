<?php

namespace Solital\Core\Http\Exceptions;

use Solital\Core\Exceptions\HttpException;

class InvalidArgumentException extends HttpException
{
    public static function alertMessage(int $code, string $msg) 
    {
        include_once ROOT.'/app/Core/Exceptions/templates/error-http.php';
        die;
    }
}
