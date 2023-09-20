<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
            'title' => 'required',
            'sub_title' => 'required',
            'article' => 'required',
            'image' => 'required|mimes:jpeg,png,jpg'
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Title Must be Filled',
            'sub_title.required' => 'Sub Title Must be Filled',
            'article.required' => 'Content Must be Filled',
            'image.required' => 'Image is Mandatory',
            'image.mimes' => 'Upload Should be Image (jpeg,png,jpg)'
        ];
    }
}
