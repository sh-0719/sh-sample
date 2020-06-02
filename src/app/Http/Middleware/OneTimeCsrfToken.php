<?php

namespace App\Http\Middleware;

use Closure;

class OneTimeCsrfToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $request->session()->regenerateToken();
        return $next($request);
    }
}
