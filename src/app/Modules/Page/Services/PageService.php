<?php

namespace App\Modules\Page\Services;

use App\Modules\Page\Entities\Page;
use Exception;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Arr;
use Throwable;

class PageService
{
    /**
     * @param array $filters
     * @return Paginator
     */
    public function list(array $filters): Paginator
    {
        $pages = Page::query()->orderBy('id');

        if (Arr::has($filters, 'name')) {
            $pages->where('name', $filters['name']);
        }

        return $pages->paginate();
    }

    /**
     * @param array $data
     * @return Page
     * @throws Exception
     */
    public function store(array $data): Page
    {
        /** @var Page $page */
        $page = Page::query()->create([
            'uri' => Arr::get($data, 'uri'),
            'name' => Arr::get($data, 'name'),
            'content' => Arr::get($data, 'content'), // TODO: tidy-html content
        ]);

        try {
            $page->saveOrFail();
        } catch (Throwable $e) {
            throw new Exception('Error storing page: ' . $e->getMessage());
        }

        return $page;
    }

    /**
     * @param Page $page
     * @param array $data
     * @return Page
     * @throws Exception
     */
    public function update(Page $page, array $data): Page
    {
        $page->uri = Arr::get($data, 'uri', $page->uri);
        $page->name = Arr::get($data, 'name', $page->name);
        // TODO: tidy-html content
        $page->content = Arr::get($data, 'content', $page->content);

        try {
            $page->saveOrFail();
        } catch (Throwable $e) {
            throw new Exception('Error updating page: ' . $e->getMessage());
        }

        return $page;
    }

    /**
     * @param Page $page
     * @return void
     * @throws Exception
     */
    public function delete(Page $page): void
    {
        try {
            $page->delete();
        } catch (Exception $e) {
            throw new Exception('Error deleting page: ' . $e->getMessage());
        }
    }
}