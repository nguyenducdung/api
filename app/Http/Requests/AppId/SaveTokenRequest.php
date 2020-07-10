<?php

namespace App\Http\Requests\Customer;

use App\Http\Requests\Base\BaseApiRequest;

class SaveTokenRequest extends BaseApiRequest
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
            'user_id' => 'numeric|required',
            'token' => 'required'
        ];
    }
}
