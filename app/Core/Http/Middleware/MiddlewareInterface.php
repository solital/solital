<?php

namespace Solital\Core\Http\Middleware;

use Solital\Core\Http\Request;

interface MiddlewareInterface
{
    /**
     * @param Request $request
     */
    public function handle(Request $request): void;

}