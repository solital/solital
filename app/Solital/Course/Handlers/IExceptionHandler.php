<?php

namespace Solital\Course\Handlers;

use Solital\Http\Request;

interface IExceptionHandler
{
    /**
     * @param Request $request
     * @param \Exception $error
     */
    public function handleError(Request $request, \Exception $error): void;

}