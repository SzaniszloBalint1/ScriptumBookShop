<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
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
            "Username"=>"required|max:255",
            "email"=>"required|email|unique:users",
            "password"=>"required|string|min:8|confirmed",
            'FullName'=>'required|max:255',
            'PhoneNumber'=>'required|max:13',
        ];
    }
}
