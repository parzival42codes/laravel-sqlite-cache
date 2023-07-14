<?php

namespace parzival42codes\LaravelSqliteCache;

use Cache;
use parzival42codes\LaravelSqliteCache\App\Commands\LaravelSqliteCacheTable;
use parzival42codes\LaravelSqliteCache\App\Extensions\SqliteStore;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelSqliteCacheServiceProvider extends PackageServiceProvider
{
    public const PACKAGE_NAME = 'laravel-sqlite-cache';

    public const PACKAGE_NAME_SHORT = 'sqlite-cache';

    public function configurePackage(Package $package): void
    {
        $package->name(self::PACKAGE_NAME)->hasCommands(LaravelSqliteCacheTable::class);
    }

    public function registeringPackage(): void
    {
    }

    public function bootingPackage(): void
    {
        Cache::extend('sqlite', function ($app) {
            return Cache::repository(new SqliteStore());
        });
    }
}
