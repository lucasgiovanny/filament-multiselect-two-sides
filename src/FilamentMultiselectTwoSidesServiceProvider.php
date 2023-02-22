<?php

namespace LucasGiovanny\FilamentMultiselectTwoSides;

use Filament\PluginServiceProvider;
use Spatie\LaravelPackageTools\Package;

class FilamentMultiselectTwoSidesServiceProvider extends PluginServiceProvider
{
    public static string $name = 'filament-multiselect-two-sides';

    protected array $styles = [
        'plugin-filament-multiselect-two-sides' => __DIR__.'/../resources/dist/filament-multiselect-two-sides.css',
    ];

    protected array $scripts = [
        'plugin-filament-multiselect-two-sides' => __DIR__.'/../resources/dist/filament-multiselect-two-sides.js',
    ];

    public function configurePackage(Package $package): void
    {
        $package->name(static::$name)
            ->hasViews()
            ->hasTranslations();
    }
}
