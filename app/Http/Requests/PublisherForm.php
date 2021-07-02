<?php

namespace App\Http\Requests;

use App\Rules\InputFieldName;
use Illuminate\Foundation\Http\FormRequest;

class PublisherForm extends FormRequest
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
            'publisher_name' => ['required', 'max:40', new InputFieldName],
            'publisher_outlet' => 'required',
            'publisher_info' => 'nullable|min:4',
            'publisher_address' => 'nullable|min:4',
            'publisher_link' => 'nullable|url',

        ];
    }
}
