<?php

namespace CodebarAg\FilamentJsonField;

use Filament\Support\Assets\Css;
use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentJsonFieldServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('filament-json-field')
            ->hasViews();
    }

    public function packageBooted()
    {
        FilamentAsset::register([
            Css::make('filament-json-field', __DIR__.'/../dist/filament-json-field.css'),
            Js::make('filament-json-field', __DIR__.'/../dist/filament-json-field.js'),
        ], 'filament-json-field');
    }
}
