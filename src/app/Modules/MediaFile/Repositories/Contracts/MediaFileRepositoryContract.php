<?php

namespace App\Modules\MediaFile\Repositories\Contracts;

use App\Modules\MediaFile\Entities\MediaFile;
use Illuminate\Support\Collection;

interface MediaFileRepositoryContract
{
    public function index(array $filters): Collection;
    public function store(array $data): MediaFile;
    public function update(MediaFile $mediaFile, array $data): MediaFile;
    public function delete(MediaFile $mediaFile): void;
}