<?php

namespace Solital\Core\Http\Middleware\Exceptions;

class TokenMismatchException extends \Exception
{
    public static function alertMessage(int $code, string $msg) 
    {
        echo "
            <body style='background: #F8F8FF;'>
                <div style='background: #FFF; padding: 15px; font-family: sans-serif;'>
                    <p><h1 style='color: #EE0000;'>Solital alert: error in code execution</h1></p><hr>
                    <p><strong>Type error:</strong> " . $code . "<br><hr></p>
                    <p><strong>Message:</strong> " . $msg . "<br><hr></p>
                </div>
            </body>
        ";
        die;
    }
}