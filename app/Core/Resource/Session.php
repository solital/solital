<?php

namespace Solital\Core\Resource;

class Session 
{
    /**
     * @param string $index
     * @param mixed $value
     */
    public static function new(string $index, $value): object
    {
        $_SESSION[$index] = (is_array($value) ? (object)$value : $value);
        return new static;
    }
    
    /**
     * @param string $index
     * @return bool
     */
    public static function delete(string $index): bool
    {
        if (isset($_SESSION[$index])) {
            unset($_SESSION[$index]);
            return true;
        }
    }
    
    /**
     * @param string $index
     */
    public static function show(string $index)
    {
        if (isset($_SESSION[$index])) {
            return $_SESSION[$index];
        }
    }

    /**
     * @param string $index
     */
    public static function has(string $index): bool
    {
        if (isset($_SESSION[$index])) {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * @return bool
     */
    public static function destroy(): bool
    {
        session_destroy();
        return true;
    }
}
