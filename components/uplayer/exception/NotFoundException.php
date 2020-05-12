<?php

namespace Component\Exception;

class NotFoundException 
{
    
    public static function fileNotFound(string $type, string $msg) 
    {
        echo "
            <body style='background: #F8F8FF;'>
                <div style='background: #FFF; padding: 15px; font-family: sans-serif;'>
                    <p><h1 style='color: #EE0000;'>Uplayer alert: error in code execution</h1></p><hr>
                    <p><strong>Type error:</strong> ".$type."<br><hr></p>
                    <p><strong>Type error:</strong> ".$msg."<br><hr></p>
                </div>
            </body>
        ";
        die;
    }
    
}
