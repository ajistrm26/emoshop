<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class ifCust
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
        if(Auth::user()->is_admin == null){
            return $next($request);    
        }else{
            \Auth::logout();
            \Session::flush();

            return redirect()->action('Auth\LoginController@index')->with('error','Kekeliruan');
        }
        
    }
}
