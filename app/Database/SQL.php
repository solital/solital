<?php

namespace Solital\Database;

use Solital\Core\Database\Create\Create;

/**
 * You can use Katrina ORM to add, remove, change columns in your database table. 
 * 
 * Read the documentation at https://solitalframework/ 
 * to use the SQL class
 */
class SQL extends Create
{
    /**
     * @return void
     */
    public function table(): void
    {
        $this->orm->createTable('table_test')
            ->int('id_table')->notNull()
            ->varchar('name', 100)->notNull()
            ->closeTable()
            ->build();
    }
}
