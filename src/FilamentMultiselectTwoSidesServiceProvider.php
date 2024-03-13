<?php

namespace LucasGiovanny\FilamentMultiselectTwoSides;

use Filament\Support\Assets\Asset;
use Filament\Support\Assets\Css;
use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentMultiselectTwoSidesServiceProvider extends PackageServiceProvider
{
    public static string $name = 'filament-multiselect-two-sides';

    public static string $viewNamespace = 'filament-multiselect-two-sides';

    public function configurePackage(Package $package): void
    {
        $package->name(static::$name)
            ->hasViews(static::$viewNamespace)
            ->hasTranslations();
    }

    public function packageBooted(): void
    {
        FilamentAsset::register(
            $this->getAssets(),
            $this->getAssetPackageName()
        );
    }

    protected function getAssetPackageName(): ?string
    {
        return 'lucasgiovanny/multiselect-two-sides';
    }

    /**
     * @return array<Asset>
     */
    protected function getAssets(): array
    {
        return [
            Css::make('filament-multiselect-two-sides-styles', __DIR__ . '/../resources/dist/filament-multiselect-two-sides.css'),
            Js::make('filament-multiselect-two-sides-scripts', __DIR__ . '/../resources/dist/filament-multiselect-two-sides.js'),
        ];
    }
}
