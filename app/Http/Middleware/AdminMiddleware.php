<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if(Auth::user() && Auth::user()->roles == 'ADMIN') {
            return $next($request);
        } else {
            return  redirect('/');
        }
    }
}
