<?php

namespace Solital\Components\Model;
use Solital\Database\ORM;

abstract class Model
{
    protected $table;
    protected $primaryKey;
    protected $columns;

    protected function instance()
    {
        $katrina = new ORM($this->table, $this->primaryKey, $this->columns);
        return $katrina;
    }
}
