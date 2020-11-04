<?php

namespace App\Http\Middleware;

use App\Models\Article;
use Closure;

class CheckArticle
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
        $articleId = $request->route()->parameter('article');

        if (!($articleId && Article::find($articleId)))
            abort(404);

        return $next($request);
    }
}
