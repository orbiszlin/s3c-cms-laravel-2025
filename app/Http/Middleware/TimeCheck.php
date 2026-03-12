<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TimeCheck
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (now()->hour >= 10 && now()->hour <= 12) {
            return $next($request);
        }

        abort(403, 'You are not allowed to access this page at this time.');
        // return $next($request);
    }
}
