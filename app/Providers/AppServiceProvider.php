<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Bin;

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
    {
        View::composer('components.navbar', function ($view) {
            $fullBins = Bin::where('weight', '>=', 15)
                            ->orderBy('id')
                            ->get(['id', 'distance']);
            $view->with('fullBins', $fullBins);
        });
    }
}
