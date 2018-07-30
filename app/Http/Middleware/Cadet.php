<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class Cadet
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
        function handle($request, Closure $next)
        {
            if (Auth::check() && Auth::user()->role == 'cadet') {
                return $next($request);
            }
            elseif (Auth::check() && Auth::user()->role == 'visitor') {
                return redirect('/visitor');
            }
            else {
                return redirect('/admin');
            }
        }
    }
}
