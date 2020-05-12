<?php

use Solital\Http\Middleware\IMiddleware;
use Solital\Http\Request;

class RewriteMiddleware implements IMiddleware {

    public function handle(Request $request)  : void {

        $request->setRewriteCallback(function() {
            return 'ok';
        });

    }

}