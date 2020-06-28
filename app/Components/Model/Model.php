<?php

namespace Solital\Components\Model;
use Katrina\Katrina;

abstract class Model
{
    protected $table;
    protected $columnPrimaryKey;
    protected $columns;

    protected function instance()
    {
        $katrina = new Katrina($this->table, $this->columnPrimaryKey, $this->columns);
        return $katrina;
    }
}
