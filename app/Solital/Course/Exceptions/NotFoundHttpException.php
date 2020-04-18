<?php

namespace Solital\Course\Exceptions;

class NotFoundHttpException extends HttpException 
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
    }
    
    public static function alertWarning(int $code, string $msg) 
    {
        echo "
            <body style='background: #F8F8FF;'>
                <div style='background: #FFF; padding: 15px; font-family: sans-serif;'>
                    <p><h1 style='color: #CDCD00;'>Solital warning: error in code execution</h1></p><hr>
                    <p><strong>Type error:</strong> " . $code . "<br><hr></p>
                    <p><strong>Message:</strong> " . $msg . "<br><hr></p>
                </div>
            </body>
        ";
    }

}
