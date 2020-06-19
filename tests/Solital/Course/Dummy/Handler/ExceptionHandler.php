<?php

class ExceptionHandler implements \Solital\Course\Handlers\IExceptionHandler
{
	public function handleError(\Solital\Http\Request $request, \Exception $error)  : void
	{
	    echo $error->getMessage();
	}

}