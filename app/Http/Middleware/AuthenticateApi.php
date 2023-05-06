<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class AuthenticateApi extends Middleware
{
    public function handle(Request $request, Closure $next, ...$guards)
    {
        if ($request->route()->getPrefix() === '/api') {
            $this->authenticate($request, $guards);
        }

        return $next($request);
    }

    protected function redirectTo($request)
    {
        return response()->json(['error' => 'Unauthenticated.'], 401);
    }
}
