<?php

namespace Laravel\Fortify\Http\Responses;

use App\Mail\RegisterSuccessMail;
use Illuminate\Http\JsonResponse;
use Laravel\Fortify\Contracts\VerifyEmailResponse as VerifyEmailResponseContract;
use Laravel\Fortify\Fortify;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class VerifyEmailResponse implements VerifyEmailResponseContract
{
    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request)
    {
        $user = User::findOrFail(Auth()->user()->id);
        $user->is_active = true;
        $user->save();
        //
        Mail::to($user->email)->send(new RegisterSuccessMail($user));
        //
        return $request->wantsJson()
            ? new JsonResponse('', 204)
            : redirect()->intended(Fortify::redirects('email-verification').'?verified=1');
    }
}
