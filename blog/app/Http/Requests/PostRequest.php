<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'title' => ['required', 'min:3'],
            'description' => ['required', 'min:10'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => "Title Can't Be Empty",
            'description.required' => "Description Can't Be Empty",
            'title.min' => "Title must Be >= 3 Characters",
            'description.min' => "Description must Be >= 10 Characters",
        ];
    }
}
