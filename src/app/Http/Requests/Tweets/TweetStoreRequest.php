<?php

namespace App\Http\Requests\Tweets;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class TweetStoreRequest
 * @package App\Http\Requests\Tweets
 */
class TweetStoreRequest extends FormRequest
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
        return [
            'body' => 'required|max:280'
        ];
    }
}
