<?php

namespace App\Modules\MediaFile\Services\Contracts;

interface MediaFileProcessorContract
{
    public function __construct(string $path);
    public function process(): void;
}