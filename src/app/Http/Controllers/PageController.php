<?php

namespace App\Http\Controllers;

use App\Http\Requests\Page\IndexRequest;
use App\Http\Requests\Page\StoreRequest;
use App\Http\Requests\Page\UpdateRequest;
use App\Modules\Page\Entities\Page;
use App\Modules\Page\Repositories\PageRepository;

class PageController extends Controller
{
    private PageRepository $repository;

    public function __construct(PageRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(IndexRequest $request)
    {
        return view('page.index', [
            'pages' => $this->repository->index($request->validated()),
        ]);
    }

    public function create()
    {
        return view('page.create');
    }

    public function store(StoreRequest $request)
    {
        //
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
        //
    }

    public function destroy(Page $page)
    {
        //
    }
}
