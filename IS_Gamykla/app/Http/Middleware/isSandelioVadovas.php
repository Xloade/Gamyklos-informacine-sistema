<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class isSandelioVadovas
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
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        if (auth()->user()->userlevel == Config::get('constants.SANDELIO_VADOVAS') || auth()->user()->userlevel == Config::get('constants.ADMINISTRATORIUS')) {
            return $next($request);
        }
        return redirect()->route('home');
    }
}
