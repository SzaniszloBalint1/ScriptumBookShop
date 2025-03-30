<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:60|unique:books',
            'author' => 'required|string|max:255',
            'isbn' => 'required|string|unique:books|size:13',
            'publish_date' => 'required|date|date_format:Y-m-d|before:tomorrow',
            'price' => 'required|numeric|min:0',
            'describe' => 'required|string',
            'cover_image' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
        ];
    }
}
