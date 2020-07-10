<?php

namespace App\Http\Requests\Bill;

use App\Http\Requests\Base\BaseApiRequest;

class StoreBillRequest extends BaseApiRequest
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
            'table_id' => 'numeric|required',
            'num_of_food' => 'gt:0',
            'price_total' => 'gt:0',
            'foods' => 'required'
        ];
    }
}
