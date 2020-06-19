<?php
require_once 'Exception/MiddlewareLoadedException.php';

use Solital\Http\Request;

class DummyMiddleware implements \Solital\Http\Middleware\IMiddleware
{
	public function handle(Request $request) : void
	{
		throw new MiddlewareLoadedException('Middleware loaded!');
	}

}