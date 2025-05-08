<?php

namespace App\Providers;

use Filament\Support\Colors\Color;
use Filament\Support\Facades\FilamentColor;
use Illuminate\Support\ServiceProvider;

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
        FilamentColor::register([
            'indigo' => Color::Indigo,
            'fuchsia' => Color::Fuchsia,
            'slate' => Color::Slate,
            'teal' => Color::Teal,
            'lime' => Color::Lime,
            'orange' => Color::Orange,
            'violet' => Color::Violet,
        ]);
    }
}
