<?php

namespace Solital\Database;
use Katrina\Katrina;
use Katrina\Connection\DB as DB;

class ORM extends Katrina
{
    public function __construct($table, $primaryKey, $columns)
    {
        parent::__construct($table, $primaryKey, $columns);
    }

    public static function query($sql)
    {
        return DB::query($sql);
    }

    public static function prepare($sql)
    {
        return DB::prepare($sql);
    }
}
