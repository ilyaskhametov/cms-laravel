<?php

namespace App\Core\Helpers;

use Illuminate\Support\Facades\Storage;

class StorageHelper
{
    /**
     * @param string|null $path
     * @param string $disk
     */
    public function deleteIfExists(string $path = null, string $disk = 'public'): void
    {
        if (null !== $path && Storage::disk($disk)->exists($path)) {
            Storage::disk($disk)->delete($path);
        }
    }
}
