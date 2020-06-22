<?php

namespace Solital\Core\Wolf;
use Solital\Core\Wolf\NotFoundException;

abstract class WolfCache
{
    protected static $file_cache;
    protected static $cache_dir = ROOT."/app/Solital/Cache/tmp/";
    protected static $time;

    public static function cache($time)
    {
        self::$time = $time;

        return self::$time;
    }
}
