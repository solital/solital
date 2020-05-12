<?php

namespace Solital\Session;
use Solital\Exceptions\NotFoundException;

class Session 
{
    
    public static function new($index, $session) 
    {
        $_SESSION[$index] = $session;
    }
    
    public static function delete($index) 
    {
        unset($_SESSION[$index]);
    }
    
    public static function show($index) 
    {
        if (isset($_SESSION[$index])) {
            return $_SESSION[$index];
        } else {
            NotFoundException::sessionNotFound($index);
        }
    }
    
    public static function destroyAll($index) 
    {
        session_destroy();
    }
}
