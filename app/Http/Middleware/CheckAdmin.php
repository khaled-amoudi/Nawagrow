<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAdmin
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

        // // if(!auth()->check() || !auth()->user()->is_admin){ abort(403); }
        // return $next($request);

        if(Auth::check()){
            if(Auth::user()->is_admin == '1'){
                return $next($request);
            } else {
                return response()->fail(400, "You Don't Have The Access !!");
            }
        } else {
            return response()->fail(401, "UnAuthinticate");
        }
    }
}
