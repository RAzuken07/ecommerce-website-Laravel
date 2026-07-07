<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Category;

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
        // Share latest categories with all views so "Browse by Category" is always up-to-date.
        try {
            $categories = Category::orderBy('name')->pluck('name');
            View::share('categories', $categories);
        } catch (\Exception $e) {
            // In case of migrations or unavailable DB, provide empty collection to avoid breaking views.
            View::share('categories', collect());
        }
    }
}
