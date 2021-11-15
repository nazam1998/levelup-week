<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Mobile
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
        $agent = new \Jenssegers\Agent\Agent;
        if (!$agent->isMobile()) {
            return $next($request);
        }
        return redirect()->back();
    }
}
