<?php

namespace App\Http\Middleware;

use App\User;
use Closure;

class Authorizing
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {
        $code = $request->route()->parameter('code');

        $user = User::where('uuid', $code)->first();

        if ($user && in_array($user->role, $roles))
            return $next($request);

        abort(403);
    }
}
