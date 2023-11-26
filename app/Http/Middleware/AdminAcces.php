<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AdminAcces
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
        //return $next($request);
        $role = Auth::User()->role;

        if($role == 1){

            return $next($request);

        }else{
            abort(403);
           //return redirect('/No-Acces') ;
        }
    }
}
