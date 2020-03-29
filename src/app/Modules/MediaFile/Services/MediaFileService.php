<?php

namespace App\Modules\MediaFile\Services;

use App\Modules\MediaFile\Entities\MediaFile;
use App\Modules\MediaFile\Helpers\MediaFileHelper;
use App\Modules\MediaFile\Services\Processors\MediaFileImageProcessor;
use Exception;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Throwable;

class MediaFileService
{
    private MediaFileHelper $helper;

    public function __construct(MediaFileHelper $helper)
    {
        $this->helper = $helper;
    }

    /**
     * @param array $filters
     * @return Paginator
     */
    public function list(array $filters): Paginator
    {
        $mediaFiles = MediaFile::query()->orderBy('id');

        if (Arr::has($filters, 'name')) {
            $mediaFiles->where('name', $filters['name']);
        }

        if (Arr::has($filters, 'type')) {
            $mediaFiles->where('type', $filters['type']);
        }

        return $mediaFiles->paginate();
    }

    /**
     * @param UploadedFile $file
     * @return MediaFile
     * @throws Exception
     */
    public function store(UploadedFile $file): MediaFile
    {
        $data = [
            'name' => $file->getClientOriginalName(),
            'type' => $this->helper->getFileTypeByMimeType($file->getClientMimeType()),
            'mime_type' => $file->getClientMimeType(),
            'uri' => Storage::disk('public')->putFile('media', $file),
        ];

        if (MediaFile::TYPE_IMAGE === $data['type']) {
            (new MediaFileImageProcessor($data['uri']))->process();
        }

        /** @var MediaFile $mediaFile */
        $mediaFile = MediaFile::query()->create($data);

        try {
            $mediaFile->saveOrFail();
        } catch (Throwable $e) {
            throw new Exception('Error storing media file: ' . $e->getMessage());
        }

        return $mediaFile;
    }

    /**
     * @param MediaFile $mediaFile
     * @param string $name
     * @return MediaFile
     * @throws Exception
     */
    public function update(MediaFile $mediaFile, string $name): MediaFile
    {
        $mediaFile->name = $name;

        try {
            $mediaFile->saveOrFail();
        } catch (Throwable $e) {
            throw new Exception('Error updating media file: ' . $e->getMessage());
        }

        return $mediaFile;
    }

    /**
     * @param MediaFile $mediaFile
     * @return void
     * @throws Exception
     */
    public function delete(MediaFile $mediaFile): void
    {
        try {
            $this->helper->deleteIfExists($mediaFile->uri);
            $mediaFile->delete();
        } catch (Exception $e) {
            throw new Exception('Error deleting media file: ' . $e->getMessage());
        }
    }
}