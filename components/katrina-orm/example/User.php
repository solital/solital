<?php

use Source\ORM\ORM as ORM;

class User
{

    # Formato String
    private $table = 'tabela_do_seu_banco';
    # Formato String
    private $primaryKey = 'chave_primária';
    # Formato Array
    private $columns = [
        'primeira_coluna_da_tabela', 
        'segunda_coluna_da_tabela',
        'outras_colunas'
    ];

    public function dbInstance()
    {
        $orm = new ORM($this->table, $this->primaryKey, $this->columns);
        return $orm;
    }

    public function listar()
    {
        $res = $this->dbInstance()->listAll();
        return $res;
    }
}
