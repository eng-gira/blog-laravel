<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MustBeAdministrator
{
    /**
     * Just a simple validation for illustration.
     */
    public function handle(Request $request, Closure $next)
    {
        // 1. These two ways are the same
        // // 1.1.
        // if (auth()->guest()) {
        //     abort(Response::HTTP_FORBIDDEN);
        // }
        // if (auth()->user()->username !== 'Admin') {
        //     abort(Response::HTTP_FORBIDDEN);
        // }
        // 1.2. (PHP 8)
        if (auth()->user()?->username != 'Admin') {
            abort(Response::HTTP_FORBIDDEN);
        }

        return $next($request);
    }
}
