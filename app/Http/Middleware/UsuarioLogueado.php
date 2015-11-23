<?php

namespace Sise\Http\Middleware;

use Closure;

class UsuarioLogueado
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
        if(!$request->session()->has('trabajador')) {
            return redirect('/login');
        }

        return $next($request);
    }
}
