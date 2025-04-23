<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaTransactionRequest extends FormRequest
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
            'sa_account_id' => ['required', 'numeric', 'exists:savings_accounts,id'],
            'date_time' => ['required', 'string'],
            'transact_type_id' => ['required', 'numeric', 'gt:0'],
            'current_balance' => ['required', 'numeric'],
            'amount' => ['required', 'numeric', 'lte:current_balance'],
            'post_balance' => ['required', 'numeric'],
            'remarks' => ['required', 'string'],
            'location' => ['required', 'string'],
            'reference_number' => ['required', 'string']
        ];
    }
}
