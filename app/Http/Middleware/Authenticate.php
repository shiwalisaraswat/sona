<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        return $next($request);
    }

    protected function redirectTo(Request $request): ?string   // added by me
    {
        if (! $request->expectsJson()) {
            if ($request->is('admin/*')) {
                return route('admin.login');
            }

            return route('login');
        }

        return null;
    }
}
