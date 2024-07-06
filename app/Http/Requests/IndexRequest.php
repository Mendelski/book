<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IndexRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'book_id' => 'required|exists:books,id',
            'parent_index_id' => 'exists:indices,id',
            'title' => 'required|string',
            'page' => 'required|integer',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
