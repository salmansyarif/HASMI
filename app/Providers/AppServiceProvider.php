<?php

namespace App\Providers;

use App\Models\Program;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
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

        // Source - https://stackoverflow.com/a/51819095
// Posted by Amitesh Bharti, modified by community. See post 'Timeline' for change history
// Retrieved 2026-02-12, License - CC BY-SA 4.0

if($this->app->environment('production')) {
    URL::forceScheme('https');
}

    });
    }
}
