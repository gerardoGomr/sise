<?php

namespace Sise\Http\Middleware;

use Closure;
use Illuminate\Support\Collection;

class DirGeneralRestriccionIp
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
        $IP = new Collection([
            '172.16.80.25',
            '::1'
        ]);

        if($IP->search($request->ip()) === false) {
            return redirect('/login');
        }

        return $next($request);
    }
}
