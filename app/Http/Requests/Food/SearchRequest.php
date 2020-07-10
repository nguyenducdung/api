<?php

namespace App\Http\Requests\Food;

use App\Http\Requests\Base\BaseApiRequest;

class SearchRequest extends BaseApiRequest
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
//            'keyword' => 'required'
        ];
    }
}
