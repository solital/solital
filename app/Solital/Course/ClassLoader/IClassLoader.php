<?php

namespace Solital\Course\ClassLoader;

interface IClassLoader
{

    public function loadClass(string $class);

    public function loadClosure(\Closure $closure, array $parameters);

}