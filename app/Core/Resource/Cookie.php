<?php

namespace Solital\Core\Resource;

class Cookie
{
    /**
     * @param string $index
     * @param mixed $value
     * @return bool
     */
    public static function new(string $index, string $value, $time = null, string $path = null): bool
    {
        setcookie($index, $value, $time, $path);
        return true;
    }
    
    /**
     * @param string $index
     * @return bool
     */
    public static function delete($index): bool
    {
        setcookie($index, NULL, -1);
        return true;
    }
    
    /**
     * @param string $index
     * @return bool
     */
    public static function show(string $index) 
    {
        if (\filter_input(INPUT_COOKIE, $index, FILTER_SANITIZE_STRING)) {
            return \filter_input(INPUT_COOKIE, $index);
        }
    }

    /**
     * @param string $index
     * @return bool
     */
    public static function has($index): bool
    {
        if (\filter_input(INPUT_COOKIE, $index)) {
            return true;
        } else {
            return false;
        }
    }    
}