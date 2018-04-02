<?php

namespace App\Http\Middleware;

use Closure;

class Admin
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
        if (auth()->user()->admin==2){
            return $next($request);
        }else{
            return redirect('/')->with('Error',true)->with('pModal',trans('Modal.pHaveNoPer'));
        }
        return $next($request);
    }
}
