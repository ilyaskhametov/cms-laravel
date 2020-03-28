<?php

namespace App\Modules\Page\Repositories\Contracts;

use App\Modules\Page\Entities\Page;
use Illuminate\Support\Collection;

interface PageRepositoryContract
{
    public function index(array $filters): Collection;
    public function create(array $data): Page;
    public function update(Page $page, array $data): Page;
    public function delete(Page $page): void;
}