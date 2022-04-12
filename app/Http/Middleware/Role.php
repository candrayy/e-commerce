<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$role)
    {
        // if (in_array($request->user()->role, $role)) {
        //     return $next($request);
        // }
        // return redirect('/');
        if(Auth::check())
        {
            if(Auth::user()->role == 'adm')
            {
                return $next($request);
            }
            else
            {
                return redirect('/beranda');
            }
        }
        else
        {
            return redirect()->back();
        }
    }
}