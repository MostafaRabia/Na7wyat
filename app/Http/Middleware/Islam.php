<?php

namespace App\Http\Middleware;

use Closure;

class Islam
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
        if (auth()->check()){
            if (auth()->user()->admin==1){
                return $next($request);
            }else{
                return redirect('/')->with('Error',true)->with('pModal',trans('Modal.pHaveNoPer'));
            }
        }else{
            return redirect('/')->with('Error',true)->with('pModal',trans('Modal.pHaveNoPer'));
        }
        return $next($request);
    }
}
