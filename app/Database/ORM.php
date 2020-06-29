<?php

namespace Solital\Database;
use Katrina\Katrina;

class ORM extends Katrina
{
    public function __construct($table, $primaryKey, $columns)
    {
        parent::__construct($table, $primaryKey, $columns);
    }
}
