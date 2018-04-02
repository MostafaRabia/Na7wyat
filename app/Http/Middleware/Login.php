<?php

namespace App\Http\Middleware;

use Closure;

class Login
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
            if (auth()->user()->admin==0||auth()->user()->admin==2){
                return $next($request);
            }elseif (auth()->check()&&auth()->user()->admin==1){
                return redirect('exams')->with('Error',true)->with('pModal',trans('Modal.pHaveNoPer'));
            }else{
                return redirect('/')->with('Error',true)->with('pModal',trans('Modal.pNotRegisterd'));
            }
        }else{
            return redirect('/')->with('Error',true)->with('pModal',trans('Modal.pNotRegisterd'));
        }
        return $next($request);
    }
}
