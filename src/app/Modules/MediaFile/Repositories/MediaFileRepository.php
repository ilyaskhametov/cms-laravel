<?php

namespace App\Modules\MediaFile\Repositories;

use App\Modules\MediaFile\Entities\MediaFile;
use App\Modules\MediaFile\Repositories\Contracts\MediaFileRepositoryContract;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Throwable;

class MediaFileRepository implements MediaFileRepositoryContract
{
    /**
     * @param array $filters
     * @return Collection
     */
    public function index(array $filters): Collection
    {
        //
    }

    /**
     * @param array $data
     * @return MediaFile
     * @throws Exception
     */
    public function store(array $data): MediaFile
    {
        try {
            /** @var MediaFile $mediaFile */
            $mediaFile = MediaFile::query()->create([
                'uri' => Arr::get($data, 'uri'),
                'name' => Arr::get($data, 'name'),
                'type' => Arr::get($data, 'type'),
                'mime_type' => Arr::get($data, 'mime_type'),
            ]);

            $mediaFile->saveOrFail();

            return $mediaFile;
        } catch (Throwable $e) {
            throw new Exception('Error storing media file: ' . $e->getMessage());
        }
    }

    /**
     * @param MediaFile $mediaFile
     * @param array $data
     * @return MediaFile
     * @throws Exception
     */
    public function update(MediaFile $mediaFile, array $data): MediaFile
    {
        try {
            $mediaFile->uri = Arr::get($data, 'uri', $mediaFile->uri);
            $mediaFile->name = Arr::get($data, 'name', $mediaFile->name);
            $mediaFile->type = Arr::get($data, 'type', $mediaFile->type);
            $mediaFile->mime_type = Arr::get($data, 'mime_type', $mediaFile->mime_type);

            $mediaFile->saveOrFail();

            return $mediaFile;
        } catch (Throwable $e) {
            throw new Exception('Error updating media file: ' . $e->getMessage());
        }
    }

    /**
     * @param MediaFile $mediaFile
     * @throws Exception
     */
    public function delete(MediaFile $mediaFile): void
    {
        try {
            $mediaFile->delete();
        } catch (Exception $e) {
            throw new Exception('Error deleting media file: ' . $e->getMessage());
        }
    }
}