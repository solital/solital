<?php

namespace Solital\Core\Exceptions;

class NotFoundHttpException extends HttpException 
{
    public static function alertMessage(int $code, string $msg) 
    {
        include_once ROOT.'/app/Core/Exceptions/templates/error-router.php';
        die;
    }
}
