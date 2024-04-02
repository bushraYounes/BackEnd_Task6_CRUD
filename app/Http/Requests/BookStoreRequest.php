<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookStoreRequest extends FormRequest
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
            'title' => 'required|string|max:500',
            'author' => 'required|json|distinct:ignore_case',
            'volume' => 'nullable|integer|min:0', //unsignedinteger
            'ISBN' => 'required|string|max:255|unique:books,ISBN', //unique:book,ISBN
            'edition' => 'nullable|integer|min:0', //unsignedinteger
            'publication_year' => 'nullable|date_format:Y',
            'publication_house' => 'nullable|string|max:255',
            'price' => 'required|numeric|min:0'
        ];
    }
}
