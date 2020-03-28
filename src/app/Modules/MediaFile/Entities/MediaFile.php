<?php

namespace App\Modules\MediaFile\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MediaFile
 * @package App\Modules\MediaFile\Entities
 *
 * @property int $id
 * @property string $uri
 * @property string $name
 * @property string $type
 * @property string $mime_type
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class MediaFile extends Model
{
    protected $fillable = [
        'uri',
        'name',
        'type',
        'mime_type',
    ];
}