<?php

namespace App\Http\Middleware;

use Closure;

class DropNull
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $notNullArray = array_filter($request->all(), function ($input) {
            return (bool)$input;
        });

        return $next($request->replace($notNullArray));
    }
}
