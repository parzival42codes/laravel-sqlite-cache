<?php

namespace parzival42codes\LaravelSqliteCache\App\Commands;

use App\Console\Commands;
use PDO;
use Storage;

class LaravelSqliteCacheTable extends Commands
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'LaravelSqliteCache:table';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sqlite Cache Install';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $path = '/sqlite';
        $filename = config('sqlite-cache.database');

        $storage = Storage::disk('storage');

        if (! $storage->directoryExists($path)) {
            $storage->makeDirectory($path);
            $storage->put($path . '/.gitignore', '
*
!.gitignore
            ');
        }

        $db = new PDO('sqlite:' . storage_path() . $path . '/' . $filename);
        $db->exec('
CREATE TABLE `cache` (
   `key` STRING PRIMARY KEY,
   `value` TEXT NOT NULL,
   `expiration` INT DEFAULT 0
);
');

        return 0;
    }
}
