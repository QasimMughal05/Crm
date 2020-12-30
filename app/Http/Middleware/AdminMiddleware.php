<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;

use Closure;

Class AdminMiddleware{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle($request,  Closure $next){

        if(Auth::user()->usertype == 'admin')
        {
            return $next($request);
        }
        else
        {
            return redirect('/home')->with('status','You Are Not Allowed To Admin Dashboard');
        }

    }

}