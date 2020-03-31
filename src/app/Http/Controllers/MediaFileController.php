<?php

namespace App\Http\Controllers;

use App\Http\Requests\MediaFile\IndexRequest;
use App\Http\Requests\MediaFile\StoreRequest;
use App\Http\Requests\MediaFile\UpdateRequest;
use App\Modules\MediaFile\Entities\MediaFile;
use App\Modules\MediaFile\Services\MediaFileService;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\MessageBag;

class MediaFileController extends Controller
{
    private MediaFileService $service;

    public function __construct(MediaFileService $service)
    {
        $this->service = $service;
    }

    public function index(IndexRequest $request)
    {
        return view('media_file.index', [
            'mediaFiles' => $this->service->list($request->validated()),
        ]);
    }

    public function create()
    {
        return view('media_file.create');
    }

    public function store(StoreRequest $request)
    {
        try {
            $mediaFile = $this->service->store($request->file('file'));
            request()->session()->flash('success', 'Media file was successfully created!');
            return redirect()->route('media_files.show', ['mediaFile' => $mediaFile->id]);
        } catch (Exception $e) {
            Log::error('Error: ' . $e->getMessage(), [$e->getTraceAsString()]);
            $errors = new MessageBag();
            $errors->add('Error', $e->getMessage());
            return redirect()->back()->withErrors($errors)->withInput();
        }
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
        try {
            $mediaFile = $this->service->update($mediaFile, $request->input('name'));
            request()->session()->flash('success', 'Media file was successfully updated!');
            return redirect()->route('media_files.show', ['mediaFile' => $mediaFile->id]);
        } catch (Exception $e) {
            Log::error('Error: ' . $e->getMessage(), [$e->getTraceAsString()]);
            $errors = new MessageBag();
            $errors->add('Error', $e->getMessage());
            return redirect()->back()->withErrors($errors)->withInput();
        }
    }

    public function destroy(MediaFile $mediaFile)
    {
        try {
            $this->service->delete($mediaFile);
            request()->session()->flash('success', 'Media file was successfully deleted!');
            return redirect()->route('media_files.index');
        } catch (Exception $e) {
            Log::error('Error: ' . $e->getMessage(), [$e->getTraceAsString()]);
            $errors = new MessageBag();
            $errors->add('Error', $e->getMessage());
            return redirect()->back()->withErrors($errors)->withInput();
        }
    }
}
