<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'user_id' => 'required|exists:users,id',
            'title' => 'required|string',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
