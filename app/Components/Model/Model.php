<?php

namespace Solital\Components\Model;

use Solital\Database\ORM;

abstract class Model
{
    /**
     * @var string
     */
    protected $table;

    /**
     * @var string
     */
    protected $primaryKey;

    /**
     * @var array
     */
    protected $columns;

    /**
     * @return ORM
     */
    protected function instance()
    {
        $katrina = new ORM($this->table, $this->primaryKey, $this->columns);
        return $katrina;
    }
}
