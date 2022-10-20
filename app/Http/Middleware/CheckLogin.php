<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        //dd(Auth()->user()->user_type);
        if(auth()->check()){  // if return true
            // if(Auth()->user()->user_type == 0){
            //     return dd('404');
            // }
            return $next($request);
        }
        else{
            return response()->view('auth.login');
            //return $next($request);
        }
    }
}
