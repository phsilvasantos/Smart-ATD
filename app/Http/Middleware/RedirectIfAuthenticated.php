<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            return redirect('/home');
        }else{
            $log = new Logger('Login');
            $log->pushHandler(new StreamHandler('path/to/Login.log', Logger::WARNING));
            $log->warning('Login: '.implode(",",$request->all()));
        }

        return $next($request);
    }
}
