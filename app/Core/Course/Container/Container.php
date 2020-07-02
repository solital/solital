<?php

namespace Solital\Core\Course\Container;

use Psr\Container\ContainerInterface;
use Solital\Core\Course\Container\Exception\ContainerException;
use Solital\Core\Course\Container\Exception\ContainerNotFoundException;

class Container implements ContainerInterface {

    /**
     * Our functions that are associated with a particular dependency.
     * */
    private $functions = [];
    
    /**
     * Our arguments that will be passed to our functions when they are first called.
     */
    private $arguments = [];
    /**
     * Our loaded dependencies that are retrieved through get()
     */
    private $loaded_dependencies = [];

    /**
     * Sets a dependency function for an identifier that returns the dependency.
     * Subsequent calls to the identifier return the first returned value of
     * the function.
     *
     * @param string $id Identifier of the entry to look for.
     * @param function $function Function whose return value will be attached to
     *                           the identifier on subsequent get() calls.
     * @param mixed $arguments Argument or arguments that are passed to the
     *                         function the first time it is called. For multiple
     *                         arguments, pass in an array.
     *
     * @return void
     */
    public function set($id, $function, $arguments = false) 
    {
        $this->functions[$id] = $function;
        $this->arguments[$id] = $arguments;
    }
    
    /**
     * Finds an entry of the container by its identifier and returns it.
     *
     * @param string $id Identifier of the entry to look for.
     *
     * @throws NotFoundExceptionInterface  No entry was found for this identifier.
     * @throws ContainerExceptionInterface Error while retrieving the entry.
     *
     * @return mixed Entry.
     */
    public function get($id) 
    {
        if(!isset($this->loaded_dependencies[$id])) {
            // If this dependency isn't yet loaded, try to load it
            if(!isset($this->functions[$id]) || !isset($this->arguments[$id])) {
              // Throw an exception ContainerNotFoundException
              throw new ContainerNotFoundException($id);
            }
            try {
                $this->loaded_dependencies[$id] = $this->functions[$id]($this->arguments[$id]);
            } catch(\Exception $exception) {
                throw new ContainerException($id, $exception);
            }
        }
        // If it's loaded or we just loaded it, cool. Return it!
        return $this->loaded_dependencies[$id];
    }
    
    /**
     * Returns true if the container can return an entry for the given identifier.
     * Returns false otherwise.
     *
     * `has($id)` returning true does not mean that `get($id)` will not throw an exception.
     * It does however mean that `get($id)` will not throw a `NotFoundException`.
     *
     * @param string $id Identifier of the entry to look for.
     *
     * @return boolean
     */
    public function has($id) 
    {
        return (isset($this->loaded_dependencies[$id]) ? true : false);
    }
}