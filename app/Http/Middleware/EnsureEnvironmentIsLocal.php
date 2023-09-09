<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Response as HttpResponses;

class EnsureEnvironmentIsLocal
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Return 404 if environment is long local.
        if (!app()->environment(['local'])) {
            abort(HttpResponses::HTTP_NOT_FOUND);
        }

        return $next($request);
    }
}
