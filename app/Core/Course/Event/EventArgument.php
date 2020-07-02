<?php

namespace Solital\Core\Course\Event;

use Solital\Core\Http\Request;
use Solital\Core\Course\Router;
use Solital\Core\Course\Event\EventArgumentInterface;

class EventArgument implements EventArgumentInterface
{
    /**
     * Event name
     * @var string
     */
    protected $eventName;

    /**
     * @var Router
     */
    protected $router;

    /**
     * @var array
     */
    protected $arguments = [];

    public function __construct($eventName, $router, array $arguments = [])
    {
        $this->eventName = $eventName;
        $this->router = $router;
        $this->arguments = $arguments;
    }

    /**
     * Get event name
     *
     * @return string
     */
    public function getEventName(): string
    {
        return $this->eventName;
    }

    /**
     * Set the event name
     *
     * @param string $name
     */
    public function setEventName(string $name): void
    {
        $this->eventName = $name;
    }

    /**
     * Get the router instance
     *
     * @return Router
     */
    public function getRouter(): Router
    {
        return $this->router;
    }

    /**
     * Get the request instance
     *
     * @return Request
     */
    public function getRequest(): Request
    {
        return $this->getRouter()->getRequest();
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function __get($name)
    {
        return $this->arguments[$name] ?? null;
    }

    /**
     * @param string $name
     * @return bool
     */
    public function __isset($name)
    {
        return array_key_exists($name, $this->arguments);
    }

    /**
     * @param string $name
     * @param mixed $value
     * @throws \InvalidArgumentException
     */
    public function __set($name, $value)
    {
        throw new \InvalidArgumentException('Not supported');
    }

    /**
     * Get arguments
     *
     * @return array
     */
    public function getArguments(): array
    {
        return $this->arguments;
    }

}