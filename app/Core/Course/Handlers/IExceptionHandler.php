<?php

namespace Solital\Core\Course\Handlers;

use Solital\Core\Http\Request;

interface IExceptionHandler
{
    /**
     * @param Request $request
     * @param \Exception $error
     */
    public function handleError(Request $request, \Exception $error): void;

}