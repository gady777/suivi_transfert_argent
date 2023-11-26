<?php

namespace Laravel\Fortify\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Laravel\Fortify\Fortify;
use Illuminate\Support\Facades\Auth;

class LoginResponse implements LoginResponseContract
{
    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request)
    {
        $role=Auth::user()->role;

        if($role == 1){
            //dd($role);
            return redirect()->route('admin.home');

        }else{

            return redirect('/home');  //Dashboard
        }

        return $request->wantsJson()
                    ? response()->json(['two_factor' => false])
                    : redirect()->intended(Fortify::redirects('login'));
    }
}
