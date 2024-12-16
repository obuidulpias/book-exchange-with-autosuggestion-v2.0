<?php

namespace App\Http\Requests\Book;

use Illuminate\Foundation\Http\FormRequest;

class ExchangeRequest extends FormRequest
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
            'book_id' => 'required|numeric',
            'ex_book_title' => 'required|string',
            'ex_book_author' => 'required|string',
            'ex_book_publication_year' => 'required|numeric|min:4',
            'ex_book_category_id' => 'required|numeric',
            'ex_book_sub_category_id' => 'required|numeric',
        ];
    }
}
