<?php

namespace App\Http\Requests\MediaFile;

use App\Modules\MediaFile\Entities\MediaFile;
use Illuminate\Foundation\Http\FormRequest;

class IndexRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'filled|string|max:255',
            'type' => 'filled|in:' . implode(',', [
                MediaFile::TYPE_AUDIO,
                MediaFile::TYPE_IMAGE,
                MediaFile::TYPE_VIDEO,
                MediaFile::TYPE_OTHER,
            ]),
        ];
    }
}
