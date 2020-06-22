<?php

namespace Solital\Core\Http\Middleware;

use Solital\Core\Http\Request;

interface IMiddleware
{
    /**
     * @param Request $request
     */
    public function handle(Request $request): void;

}