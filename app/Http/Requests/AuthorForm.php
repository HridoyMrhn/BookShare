<?php

namespace App\Http\Requests;

use App\Rules\InputFieldName;
use Illuminate\Foundation\Http\FormRequest;

class AuthorForm extends FormRequest
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
            'author_name' => ['required', 'max:40', new InputFieldName],
            'author_info' => 'nullable|min:6'
        ];
    }

}
