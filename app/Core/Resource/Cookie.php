<?php

namespace Solital\Core\Cookie;
use Solital\Core\Exceptions\NotFoundException;

class Cookie {
    
    public static function new($index, $cookie, $time = null) 
    {
        setcookie($index, $cookie, $time);
        return true;
    }
    
    public static function delete($index) 
    {
        setcookie($index, NULL, -1);
        return true;
    }
    
    public static function show($index) 
    {
        if (isset($_COOKIE[$index])) {
            return $_COOKIE[$index];
        }
    }
    
}
