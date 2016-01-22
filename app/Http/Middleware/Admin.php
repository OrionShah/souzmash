<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Guard;

class Admin
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
        print_r('expression');die;
        var_dump(Auth::user());die;
        // if (Auth::check()) {
            // if (Auth::user()->is_admin) {
                return $next($request);
            // }
        // }
        // return redirect('/');
    }
}
