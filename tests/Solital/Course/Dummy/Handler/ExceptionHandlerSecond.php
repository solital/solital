<?php

class ExceptionHandlerSecond implements \Solital\Course\Handlers\IExceptionHandler
{
	public function handleError(\Solital\Http\Request $request, \Exception $error) : void
	{
        global $stack;
        $stack[] = static::class;

        $request->setUrl(new \Solital\Http\Url('/'));
	}

}