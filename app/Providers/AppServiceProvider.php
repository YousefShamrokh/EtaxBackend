<?php

namespace App\Providers;

use App\Models\Book;
use Illuminate\Support\ServiceProvider;
use App\Observers\BookObserver;

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
        //
        Book::observe(BookObserver::class);
    }
}
