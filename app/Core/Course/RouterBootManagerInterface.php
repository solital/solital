<?php

namespace Solital\Core\Course;

use Solital\Core\Http\Request;

interface RouterBootManagerInterface
{
    /**
     * Called when router loads it's routes
     *
     * @param Router $router
     * @param Request $request
     */
    public function boot(Router $router, Request $request): void;
}