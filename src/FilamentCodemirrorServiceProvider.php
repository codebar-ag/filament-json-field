<?php

namespace CodebarAg\FilamentCodemirror;

use Filament\Support\Assets\Css;
use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentCodemirrorServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('filament-codemirror')
            ->hasConfigFile()
            ->hasViews();
    }

    public function packageBooted()
    {
        FilamentAsset::register([
            Css::make('codemirror', __DIR__.'/../dist/codemirror.css'),
            Js::make('codemirror', __DIR__.'/../dist/codemirror.js'),
        ], 'filament-codemirror');
    }
}
