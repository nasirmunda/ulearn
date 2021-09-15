<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Educator
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth()->user()->role == "educator"){
            return $next($request);
        }

        return redirect('home')->with('error',"Only admin can access!");
    }
}
