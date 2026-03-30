<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ContactRequest extends FormRequest
{

    public function authorize()
    {
        return true; // allow both guest & logged-in users
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                auth()->check() ? 'nullable' : 'required',
                'string', 'max:255'
            ],
            'email' => [
                auth()->check() ? 'nullable' : 'required',
                'email', 'max:255'
            ],
            'message' => ['required', 'string', 'min:10']
        ];
    }
}
