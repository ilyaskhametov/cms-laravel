<?php

namespace App\Http\Controllers;

use App\Http\Requests\Page\IndexRequest;
use App\Http\Requests\Page\StoreRequest;
use App\Http\Requests\Page\UpdateRequest;
use App\Modules\Page\Entities\Page;
use App\Modules\Page\Services\PageService;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\MessageBag;

class PageController extends Controller
{
    private PageService $service;

    public function __construct(PageService $service)
    {
        $this->service = $service;
    }

    public function index(IndexRequest $request)
    {
        return view('page.index', [
            'pages' => $this->service->list($request->validated()),
        ]);
    }

    public function create()
    {
        return view('page.create');
    }

    public function store(StoreRequest $request)
    {
        try {
            $page = $this->service->store($request->validated());
            request()->session()->flash('success', 'Page was successfully created!');
            return redirect()->route('pages.show', ['page' => $page->id]);
        } catch (Exception $e) {
            Log::error('Error: ' . $e->getMessage(), [$e->getTraceAsString()]);
            $errors = new MessageBag();
            $errors->add('Error', $e->getMessage());
            return redirect()->back()->withErrors($errors)->withInput();
        }
    }

    public function show(Page $page)
    {
        return view('page.show', compact($page));
    }

    public function edit(Page $page)
    {
        return view('page.edit', compact($page));
    }

    public function update(UpdateRequest $request, Page $page)
    {
        try {
            $page = $this->service->update($page, $request->validated());
            request()->session()->flash('success', 'Page was successfully updated!');
            return redirect()->route('pages.show', ['page' => $page->id]);
        } catch (Exception $e) {
            Log::error('Error: ' . $e->getMessage(), [$e->getTraceAsString()]);
            $errors = new MessageBag();
            $errors->add('Error', $e->getMessage());
            return redirect()->back()->withErrors($errors)->withInput();
        }
    }

    public function destroy(Page $page)
    {
        try {
            $this->service->delete($page);
            request()->session()->flash('success', 'Page was successfully deleted!');
            return redirect()->route('pages.index');
        } catch (Exception $e) {
            Log::error('Error: ' . $e->getMessage(), [$e->getTraceAsString()]);
            $errors = new MessageBag();
            $errors->add('Error', $e->getMessage());
            return redirect()->back()->withErrors($errors)->withInput();
        }
    }
}
