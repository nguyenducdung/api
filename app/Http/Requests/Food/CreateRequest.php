<?php

namespace App\Http\Requests\Food;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
            'name' => 'required',
            'time' => 'required',
            'price' => 'required',
            'image' => 'image|mimes:jpg,jpeg,gif,png'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Tên món ăn không để trống',
            'time.required' => 'Thời gian chuẩn bị không để trống',
            'price.required' => 'Giá không để trống',
            'image.mimes' => 'Ảnh phải thuộc định dạng :mimes',
            'image.image' => 'File upload phải là file ảnh'
        ];
    }
}
