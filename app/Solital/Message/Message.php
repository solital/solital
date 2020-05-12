<?php

namespace Solital\Message;
use Solital\Session\Session;

class Message 
{
    
    private static $msg;
    private static $index;
    
    public static function newMessage(string $index , string $msg)
    {
        return Session::new($index, $msg);
    }
    
    public static function getMessage(string $index)
    {
        if (isset($_SESSION[$index])) {
            return $_SESSION[$index];
        }
    }
    
    public static function clearMessage(string $index) {
        if (isset($_SESSION[$index])) {
            unset($_SESSION[$index]);
        }
    }
    
}
