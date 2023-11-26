<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Devise;
use App\Models\Question;

class AppServiceProvider extends ServiceProvider
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
        view()->composer(['usersView.*' ], function ($view)
        {
            $devises = Devise::all();
             $view->with('les_devises', $devises );
        });

        view()->composer(['usersView.setting' ], function ($view)
        {
            $quizs = Question::all();
             $view->with('les_quizs', $quizs );
        });
    }
}
