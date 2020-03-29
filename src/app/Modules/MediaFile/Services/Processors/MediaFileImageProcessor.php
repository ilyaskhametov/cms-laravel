<?php

namespace App\Modules\MediaFile\Services\Processors;

use App\Modules\MediaFile\Services\Contracts\MediaFileProcessorContract;

class MediaFileImageProcessor implements MediaFileProcessorContract
{
    private string $path;

    public function __construct(string $path)
    {
        $this->path = $path;
    }

    public function process(): void
    {
        // TODO: Minify image
    }
}