<?php

namespace App\Http\Middleware;

use Auth;
use Closure;


class Visitor
{

    public function handle($request, Closure $next)
    {


            if (Auth::check() && Auth::user()->role == 'visitor') {
                return $next($request);
            }
            elseif (Auth::check() && Auth::user()->role == 'customer') {
                return redirect('/customer');
            }
            elseif (Auth::check() && Auth::user()->role == 'admin'){
                return redirect('/admin');
            }else{
               dd( "no auth");
            }

    }
}
