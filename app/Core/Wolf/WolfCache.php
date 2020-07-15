<?php

namespace Solital\Core\Wolf;

abstract class WolfCache
{
    /**
     * @var string
     */
    protected static $file_cache;

    /**
     * @var string
     */
    protected static $cache_dir = ROOT."/app/Solital/Cache/tmp/";

    /**
     * @var date
     */
    protected static $time;

    /**
     * @param date $time
     */
    public static function cache($time)
    {
        self::$time = $time;

        return self::$time;
    }
}
