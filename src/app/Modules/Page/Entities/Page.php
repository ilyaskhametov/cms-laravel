<?php

namespace App\Modules\Page\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Page
 * @package App\Modules\Page\Entities
 *
 * @property int $id
 * @property string $uri
 * @property string $name
 * @property string $content
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Page extends Model
{
    protected $fillable = [
        'uri',
        'name',
        'content',
    ];
}