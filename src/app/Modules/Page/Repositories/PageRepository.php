<?php

namespace App\Modules\Page\Repositories;

use App\Modules\Page\Entities\Page;
use App\Modules\Page\Repositories\Contracts\PageRepositoryContract;
use Illuminate\Support\Collection;

class PageRepository implements PageRepositoryContract
{
    public function index(array $filters): Collection
    {
        //
    }

    public function create(array $data): Page
    {
        //
    }

    public function update(Page $page, array $data): Page
    {
        //
    }

    public function delete(Page $page): void
    {
        //
    }
}