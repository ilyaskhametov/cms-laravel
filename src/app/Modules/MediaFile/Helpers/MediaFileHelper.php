<?php

namespace App\Modules\MediaFile\Helpers;

use App\Modules\MediaFile\Entities\MediaFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MediaFileHelper
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

    /**
     * @param string $mimeType
     * @return string
     */
    public function getFileTypeByMimeType(string $mimeType): string
    {
        if (Str::contains($mimeType, 'audio/')) {
            return MediaFile::TYPE_AUDIO;
        } elseif (Str::contains($mimeType, 'image/')) {
            return MediaFile::TYPE_IMAGE;
        } elseif (Str::contains($mimeType, 'video/')) {
            return MediaFile::TYPE_VIDEO;
        } else {
            return MediaFile::TYPE_OTHER;
        }
    }
}
