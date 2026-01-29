<?php

namespace App\Providers;

use App\Models\Program;
use Illuminate\Support\ServiceProvider;
use View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {    View::composer('*', function ($view) {
        $navPrograms = Program::parents()
            ->with('children')
            ->orderBy('sort_order')
            ->get();

        $view->with('navPrograms', $navPrograms);
    });
    }
}
