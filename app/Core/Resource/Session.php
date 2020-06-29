<?php

namespace Solital\Core\Session;
use Solital\Core\Exceptions\NotFoundException;

class Session 
{
    
    public static function new($index, $session) 
    {
        $_SESSION[$index] = $session;
        return $_SESSION[$index];
    }
    
    public static function delete($index) 
    {
        unset($_SESSION[$index]);
        return true;
    }
    
    public static function show($index) 
    {
        if (isset($_SESSION[$index])) {
            return $_SESSION[$index];
        }
    }
    
    public static function destroyAll($index) 
    {
        session_destroy();
        return true;
    }
}
