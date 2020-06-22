<?php

namespace Solital\Core\Exceptions;

class NotFoundException 
{
    
    public static function indexNotFound(string $type, string $msg) 
    {
        echo "
            <body style='background: #F8F8FF;'>
                <div style='background: #FFF; padding: 15px; font-family: sans-serif;'>
                    <p><h1 style='color: #EE0000;'>Guardian alert: error in code execution</h1></p><hr>
                    <p><strong>Type error:</strong> " . $type . "<br><hr></p>
                    <p><strong>Message:</strong> " . $msg . "<br><hr></p>
                </div>
            </body>
        ";
        die;
    }
    
    public static function sessionNotFound(string $msg) 
    {
        echo "<p style='color: #B8860B; font-weight: bold; font-size: 20px; font-family: sans-serif;'>
        Warning: '$msg' session does not exist
        </p>";
    }
    
    public static function cookieNotFound(string $msg) 
    {
        echo "<p style='color: #B8860B; font-weight: bold; font-size: 20px; font-family: sans-serif;'>
        Warning: '$msg' cookie does not exist
        </p>";
    }
    
}
