<?php

namespace Solital\Http\Middleware;

use Solital\Http\Request;

interface IMiddleware
{
    /**
     * @param Request $request
     */
    public function handle(Request $request): void;

}