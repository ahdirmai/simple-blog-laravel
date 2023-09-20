<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|unique:posts',
            'sub_title' => 'required',
            'article' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Title Must be Filled',
            'title.unique' => 'Title Must be Unique',
            'sub_title.required' => 'Sub Title Must be Filled',
            'article.required' => 'Content Must be Filled'

        ];
    }
}
