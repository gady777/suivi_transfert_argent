<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
            return Limit::perMinute(5)->by($request->email.$request->ip());
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

        Fortify::loginView(function(){
            return view('auth.login');
        });

        Fortify::registerView(function(){
            //return view('auth.signup');
        });

        Fortify::verifyEmailView(function () {
            return view('auth.verify-email');
        });

        Fortify::authenticateUsing(function (Request $request) {
            if($request->type_actor =="admin"){ 
                $user = User::where('email', $request->email)
                              ->where('role',1)
                              ->where('is_active',true)
                              ->first(); 
                if ($user && Hash::check($request->password, $user->password)) { 
                    return $user; 
                } 
            }elseif($request->type_actor =="user"){ 
                $user = User::where('email', $request->email)
                             ->where('is_active',true)
                             ->where('role','!=',1)
                             ->first(); 
                if ($user && Hash::check($request->password, $user->password)) { 
                    return $user; 
                } 
            }
            /*$user = User::where('email', $request->email)->where('is_active',true)->first();

            if ($user && Hash::check($request->password, $user->password)) {
                return $user;
            }*/
        });

        Fortify::requestPasswordResetLinkView(function(){
             return view('auth.forgot-password');
        });

        Fortify::resetPasswordView(function($request){
            return view('auth.reset-password',['request'=>$request]);
        });

    }
}
