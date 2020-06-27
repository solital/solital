<?php

namespace Solital\Core\Course\ClassLoader;

interface ClassLoaderInterface
{

    public function loadClass(string $class);

    public function loadClosure(\Closure $closure, array $parameters);

}