<?php

namespace Solital\Core\Course\Route;

interface ControllerRouteInterface extends RouteInterface
{
    /**
     * Get controller class-name
     *
     * @return string
     */
    public function getController(): string;

    /**
     * Set controller class-name
     *
     * @param string $controller
     * @return static
     */
    public function setController(string $controller): self;

}