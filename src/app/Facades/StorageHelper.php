<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class DictionaryItem
 * @package App\Facades
 *
 * @method static void deleteIfExists(string $path = null, string $disk = 'public')
 */
class StorageHelper extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'StorageHelper';
    }
}
