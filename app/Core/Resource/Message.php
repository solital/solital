<?php

namespace Solital\Core\Resource;
use Solital\Core\Resource\Session;

class Message 
{
    /**
     * @param string $index
     * @param string $msg
     */
    public static function new(string $index , string $msg): Message
    {
        Session::new($index, $msg);
        return new static;
    }
    
    /**
     * @param string $index
     */
    public static function get(string $index): string
    {
        if (isset($_SESSION[$index])) {
            return (string)$_SESSION[$index];
        }
    }
    
    /**
     * @param string $index
     * @return bool
     */
    public static function clear(string $index): bool
    {
        if (isset($_SESSION[$index])) {
            unset($_SESSION[$index]);
            return true;
        } else {
            return false;
        }
    }    
}
