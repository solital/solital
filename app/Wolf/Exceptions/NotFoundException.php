<?php

namespace Wolf;

abstract class NotFoundException 
{
    
    public static function alertMessage(string $view, string $ext) 
    {
        echo "
            <body style='background: #F8F8FF;'>
                <div style='background: #FFF; padding: 15px; font-family: sans-serif;'>
                    <p><h1 style='color: #EE0000;'>Template alert</h1></p><hr>
                    <p><strong>Type error:</strong> Template '".$view.".".$ext."' not found<br><hr></p>
                </div>
            </body>
            ";
    }
    
}
