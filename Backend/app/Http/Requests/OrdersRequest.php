<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrdersRequest extends FormRequest
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
            'items' => 'required|array',
            'items.*.book_id' => 'required|exists:books,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.price' => 'required|numeric|min:0',
            'items.*.books_total_price' => 'required|numeric|min:0',
            'shipping.name' => 'required|string|min:3',
            'shipping.email' => 'required|email',
            'shipping.phone' => 'required|string',
            'shipping.address' => 'required|string',
            'shipping.method' => 'required|in:home,pickup',
            'shipping.fee' => 'required|numeric',
            'payment_method' => 'required|string',
            'total_amount' => 'required|numeric',
            'reference_id' => 'nullable|string'
        ];
    }
}
