<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

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
        Blade::component('layouts.components.menu', 'menu');
        Blade::component('layouts.components.modal', 'modal');


        view()->composer('layouts.components.menu', function($view)
        {
            $isRecuperation  = 'Online';
            $hasSportClass = \App\User::withCount('studentClass')->findOrFail(Auth::id())->student_class_count;

            $view->with('data', ['isRecuperation' => $isRecuperation, 'hasSportClass' => $hasSportClass]);
        });
    }
}
