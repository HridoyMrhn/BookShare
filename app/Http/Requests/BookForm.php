<?php

namespace App\Http\Requests;

use App\Rules\InputFieldName;
use Illuminate\Foundation\Http\FormRequest;

class BookForm extends FormRequest
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
            'book_name' => ['required', 'max:40', new InputFieldName],
            'book_image' => 'image|max:1500',
            'category_id' => 'required',
            'publisher_id' => 'required',
            'book_info' => 'required',
            'book_quantity' => 'required|min:1'
        ];
    }
}
