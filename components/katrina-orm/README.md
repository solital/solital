# Abstração do DB

Abstração é uma lib na qual abstrai os dados do banco de dados. Ele utiliza o PDO como base.

Com a abstração você pode:

- Realizar o CRUD (Ler, criar, alterar, deletar);
- Listar campos que possuiem INNER JOIN
- Chamar procedures
- Verificar login

## Básico

Para inicializar, instancie a classe ORM na sua classe desejada.

```php

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
        ...
    ];

    public function dbInstance()
    {
        $orm = new ORM($this->table, $this->primaryKey, $this->columns);
        return $orm;
    }

    public function get()
    {
        $res = $this->dbInstance()->listAll();
        return $res;
    }
}

```

### Listar

Para listar todos os campos da tabela, utilize o `listAll()` como mostrado no exemplo anterior.

Por padrão, o metódo irá listar todos os campos da tabela. Para especificar quais campos deseja listar, passe os valores como parâmetros.

```php

    public function get()
    {
        $res = $this->dbInstance()->listAll('name, city, country');
        return $res;
    }
}

```

Utilize o `listOnlyId()` para retornar apenas um único valor da tabela.

```php

    public function get()
    {
        $res = $this->dbInstance()->listOnlyId(3);
        return $res;
    }
}

```

Ou especifique os campos que você queira retornar.

```php

    public function get()
    {
        $res = $this->dbInstance()->listOnlyId('name, city, country', 3);
        return $res;
    }
}

```

### Inserir

O método `insert()` insere os valores na tabela. Para isso crie um array com os valores que o método irá receber

```php

    public function insert()
    {
        $res = $this->dbInstance()->insert(['Clark', 'Metropolis', 'EUA']);
        return $res;
    }
}

```

### Atualizar

O método `update()` atualiza os valores na tabela. Antes utilize o método `colUpdate()` Para especificar as colunas que serão atualizadas. Em seguida  crie um array com os valores que o método irá receber junto com a chave primária.

```php

    public function update()
    {
        $this->dbInstance()->colUpdate(['name']);
        $res = $this->dbInstance()->update(['Clark'], 3);
        return $res;
    }
}

```

### Delete

O método `delete()` apaga os valores na tabela. Passe a chave primaria dentro do método

```php

    public function delete()
    {
        $res = $this->dbInstance()->delete(3);
        return $res;
    }
}

```

Caso queira apagar toda a tabela, utilize `true` após a chave primária.

```php

    public function delete()
    {
        $res = $this->dbInstance()->delete(3, true);
        return $res;
    }
}

```

### Procedure

O método `call()` chama a procedure do banco de dados.

```php

    public function delete()
    {
        $res = $this->dbInstance()->call('procedure_name');
        return $res;
    }
}

```

Para utilizar parâmetros, passe os valores em formato de array.

```php

    public function delete()
    {
        $res = $this->dbInstance()->call('procedure_name', ['param_1, param_2, param_3']);
        return $res;
    }
}

```

### Verificar login

O método `verifyLogin()` verifica se existe o usuário informado na tabela. O primerio campo irá verificar a tabela na qual o usuário e a senha estão, o segundo campo será informado o usuário ou e-mail que está na tabela e o terceiro campo será a senha. Se o usuário ou a senha estiverem incorretos, o método retornará `false`. Caso contrário irá retornar `true`.

```php

    public function delete()
    {
        $res = $this->dbInstance()
                    ->verifyLogin('email', 'clark@gmail.com', 'behindblueeyes');
        
        return $res;
    }
}

```

### Inner join

O método `innerJoin()` retorna os valores de duas tabelas que possuiem chave estrangeira. Informe o nome da tabela e o campo da outra tabela que possui a chave primária da sua tabela principal.

```php

    public function delete()
    {
        $res = $this->dbInstance()->innerJoin('address', 'idAddress');
        return $res;
    }
}

```

Você pode informar quais campos deseja retornar. "a" é a sua tabela principal enquanto "b" é a sua tabela que possui a chave estrangeira.

```php

    public function delete()
    {
        $res = $this->dbInstance()
                    ->innerJoin('a.idPerson, a.name, b.street','address', 'idAddress');
        
        return $res;
    }
}

```

Se quiser retornar apenas um único valor, utilize `innerJoinId()` adicionando a chave primária no final.

```php

    public function delete()
    {
        $res = $this->dbInstance()
                    ->innerJoin('a.idPerson, a.name, b.street','address', 'idAddress', 3);
        
        return $res;
    }
}

```