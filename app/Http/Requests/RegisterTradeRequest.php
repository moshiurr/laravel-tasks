<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterTradeRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'trademark_name'=> 'required|string',
            'category_id'=> 'required|int|min:1',
            'owner_id' => 'required|int',
            'registration' => 'required|date',
            'expiration' => 'required|date'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
