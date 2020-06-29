<?php

namespace Solital\Core\Http\Exceptions;

class RuntimeException extends \RuntimeException
{
    public static function alertMessage(string $msg) 
    {
        include_once ROOT.'/app/Core/Exceptions/templates/error-runtime.php';
        die;
    }
}
