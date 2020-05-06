<?php

namespace App\Http\Requests\Media;

use App\Prototypes\Media\MimeTypes;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class MediaStoreRequest
 * @package App\Http\Requests\Media
 */
class MediaStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
//       dd($this->media[0]->getMimeType(),  'required|mimetypes:' . implode(',', MimeTypes::all()));
        return [
            'media.*' => 'required|mimetypes:' . implode(',', MimeTypes::all())
        ];
    }
}
