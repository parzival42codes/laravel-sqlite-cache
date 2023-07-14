<?php

namespace parzival42codes\LaravelSqliteCache\App\Extensions;

use Config;
use Illuminate\Cache\DatabaseStore;

class SqliteStore extends DatabaseStore
{
    public function __construct()
    {
        /** @var array $config */
        $config = config('cache.stores.sqlite');

        // Set the temporary configuration
        Config::set('database.connections.sqlite_cache', [
            'driver' => 'sqlite',
            'database' => $config['database'],
            'prefix' => $config['prefix'],
        ]);

        $connection = app('db')->connection('sqlite_cache');
        parent::__construct($connection, $config['table'], $config['prefix']);
    }
}
