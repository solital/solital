<?php

namespace Solital\Core\Course\ClassLoader;

use Solital\Core\Exceptions\NotFoundHttpException;

class ClassLoader implements ClassLoaderInterface
{

    /**
     * @var Container|null
     */
    protected $container;

    /**
     * Load class
     *
     * @param string $class
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function loadClass(string $class)
    {
        if (class_exists($class) === false) {
            NotFoundHttpException::alertMessage(404, "Class '$class' does not exist");
        }

        return new $class();
    }

    /**
     * Load closure
     *
     * @param \Closure $closure
     * @param array $parameters
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function loadClosure(\Closure $closure, array $parameters)
    {
        return \call_user_func_array($closure, $parameters);
    }

}