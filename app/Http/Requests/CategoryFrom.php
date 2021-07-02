<?php

namespace App\Http\Requests;

use App\Rules\InputFieldName;
use Illuminate\Foundation\Http\FormRequest;

class CategoryFrom extends FormRequest
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
            'category_name' => ['required', new InputFieldName]
            // 'category_name' => ['required', 'unique:categories,category_name,'.$this->id, new InputFieldName]
        ];
    }
}
