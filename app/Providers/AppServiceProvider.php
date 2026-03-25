<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

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
        /**
         * PAGINATION STYLING:
         * By default, Laravel uses Tailwind CSS for pagination. 
         * This line overrides that behavior to ensure {!! $records->links() !!} 
         * generates HTML compatible with Bootstrap 5 classes (ul, li, page-item, etc.).
         */
        \Illuminate\Pagination\Paginator::useBootstrapFive();

        // Note: If you ever downgrade to Bootstrap 4, change this to:
        // Paginator::useBootstrapFour();
    }
}
