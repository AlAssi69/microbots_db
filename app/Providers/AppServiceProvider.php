<?php

namespace App\Providers;

use Filament\Support\Facades\FilamentView;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Blade;
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
        FilamentView::registerRenderHook(
            name: 'panels::user-menu.before',
            hook: fn (): string => Blade::render('@livewire(\'components.backup-component\')'),
        );

        Table::configureUsing(function (Table $table) {
            return $table
                ->filtersLayout(FiltersLayout::Modal)
                ->deferFilters();
        });
    }
}
