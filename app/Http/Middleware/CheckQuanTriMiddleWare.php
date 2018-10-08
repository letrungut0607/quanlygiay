<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckQuanTriMiddleWare
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
        if (Auth::user()->phanquyen === 0) {
            return redirect('/admin/dashboard');
        }

        return $next($request);
    }
}
