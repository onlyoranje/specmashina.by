<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class OnEnter
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::guest() and Auth::user()->is_admin)
        {
            Config::set('app.debug', true);
        }
    }
}
