<?php

namespace Solital\Core\Course\Event;

use Solital\Core\Http\Request;
use Solital\Core\Course\Router;

interface EventArgumentInterface
{

    /**
     * Get event name
     *
     * @return string
     */
    public function getEventName(): string;

    /**
     * Set event name
     *
     * @param string $name
     */
    public function setEventName(string $name): void;

    /**
     * Get router instance
     *
     * @return Router
     */
    public function getRouter(): Router;

    /**
     * Get request instance
     *
     * @return Request
     */
    public function getRequest(): Request;

    /**
     * Get all event arguments
     *
     * @return array
     */
    public function getArguments(): array;

}