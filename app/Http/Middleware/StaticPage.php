<?php

namespace App\Http\Middleware;

use Closure;

use App\Page;
use App;

class StaticPage
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
        $pages = Page::all();
        $links = [];
        foreach ($pages as $page) {
            $links[] = $page->link;
        }

        if (in_array($request->path(), $links)) {
            return $next($request);
        }
    }
}
