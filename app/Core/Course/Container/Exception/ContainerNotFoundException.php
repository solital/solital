<?php

namespace Solital\Core\Course\Container\Exception;

use Psr\Container\NotFoundExceptionInterface;

class ContainerNotFoundException extends \Exception implements NotFoundExceptionInterface
{
    // Redefine the exception so message isn't optional
    public function __construct($id, $code = 0, \Exception $previous = null)
    {
        parent::__construct("Dependency \"" . $id . "\" not found. Make sure it is properly injected in this domain", $code, $previous);
    }
}