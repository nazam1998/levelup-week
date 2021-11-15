<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class editor
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
        $note=$request->route()->parameters()['note'];
        if(Auth::id() == $note->author_id || $note->shared->contains(Auth::id())){

            return $next($request);
        }
        return redirect()->back();
    }
}
