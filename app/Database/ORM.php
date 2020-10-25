<?php

namespace Solital\Database;
use Katrina\Katrina;
use Katrina\Connection\DB as DB;

class ORM extends Katrina
{    
    /**
     * __construct
     *
     * @param  mixed $table
     * @param  mixed $primaryKey
     * @param  mixed $columns
     * @return void
     */
    public function __construct($table, $primaryKey, $columns)
    {
        parent::__construct($table, $primaryKey, $columns);
    }
    
    /**
     * query
     *
     * @param  mixed $sql
     * @return void
     */
    public static function query($sql)
    {
        return DB::query($sql);
    }
    
    /**
     * prepare
     *
     * @param  mixed $sql
     * @return void
     */
    public static function prepare($sql)
    {
        return DB::prepare($sql);
    }
}
