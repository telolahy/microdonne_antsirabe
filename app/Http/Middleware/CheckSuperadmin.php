<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckSuperadmin
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
       /* return $next($request); */
        if (Auth::check() && Auth::user()->isSuperadmin()) {
            return $next($request);
        }
        return redirect()->route('front-office');  // Rediriger si ce n'est pas un superadmin
    }
}
