<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'full_name' => ['required', 'string'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
            'role_id' => ['required', 'numeric']
        ];
    }

    public function attributes()
    {
        return [
            'role_id' => 'Role'
        ];
    }
}
