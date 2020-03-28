<?php

namespace App\Http\Controllers;

use App\Http\Requests\MediaFile\IndexRequest;
use App\Http\Requests\MediaFile\StoreRequest;
use App\Http\Requests\MediaFile\UpdateRequest;
use App\Modules\MediaFile\Entities\MediaFile;
use App\Modules\MediaFile\Repositories\MediaFileRepository;

class MediaFileController extends Controller
{
    private MediaFileRepository $repository;

    public function __construct(MediaFileRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(IndexRequest $request)
    {
        return view('media_file.index', [
            'mediaFiles' => $this->repository->index($request->validated()),
        ]);
    }

    public function create()
    {
        return view('media_file.create');
    }

    public function store(StoreRequest $request)
    {
        //
    }

    public function show(MediaFile $mediaFile)
    {
        return view('media_file.show', compact($mediaFile));
    }

    public function edit(MediaFile $mediaFile)
    {
        return view('media_file.edit', compact($mediaFile));
    }

    public function update(UpdateRequest $request, MediaFile $mediaFile)
    {
        //
    }

    public function destroy(MediaFile $mediaFile)
    {
        //
    }
}
