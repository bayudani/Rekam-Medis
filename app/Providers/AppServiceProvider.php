<?php

namespace App\Providers;
use Illuminate\Support\Carbon;

use Illuminate\Support\ServiceProvider;
use Filament\Support\Facades\FilamentAsset;
use App\Forms\Components\Odontogram;

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
                Carbon::setLocale('id'); // Tambahkan ini
                // FilamentAsset::register([Odontogram::class]);

    }
}
