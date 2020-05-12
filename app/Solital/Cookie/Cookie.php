<?php

namespace Solital\Cookie;
use Solital\Exceptions\NotFoundException;

class Cookie {
    
    public static function new($index, $cookie, $time = null) 
    {
        setcookie($index, $cookie, $time);
    }
    
    public static function delete($index) 
    {
        setcookie($index, NULL, -1);
    }
    
    public static function show($index) 
    {
        if (isset($_COOKIE[$index])) {
            return $_COOKIE[$index];
        } else {
            NotFoundException::cookieNotFound($index);
        }
    }
    
}
