# PHP API

API é uma lib na qual consome api.

## Básico

Para inicializar, instancie a classe callCurl.

```php

<?php

require_once 'vendor/autoload.php';

use Source\callCurl\callCurl as callCurl;

$curl = new callCurl("http://your-endpoint");
$res = $curl->get();

echo $res;

```

### Métodos

Os métodos da API estão listados abaixo:

```php

    $curl = new callCurl("http://your-endpoint");
    $curl->get(string $token, bool $decode, string $accept, string $contentType);
    $curl->post(array $data, string $token, string $accept, string $contentType);
    $curl->put(array $data, string $token, string $accept, string $contentType);
    $curl->delete(string $token, string $accept, string $contentType);
}

```

`$token`: por padrão é `false`. Não é obrigatório informar uma `string`, apenas se for necessário.
`$decode`: por padrão é `false`. Se `true`, o resultado é retornado decodificado em array.
`$accept`: por padrão é `application/json`.
`$contentType`: por padrão é `application/json`.