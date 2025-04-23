<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MayaTransactionRequest extends FormRequest
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
            // exists - specify the actual table name in database
            'maya_id' => ['required', 'numeric', 'exists:maya_accounts,id'],
            'date_time' => ['required', 'string'],
            'transact_type_id' => ['required', 'numeric', 'gt:0'],
            'current_balance' => ['required', 'numeric'],
            'amount' => ['required', 'numeric', 'lte:current_balance'],
            'post_balance' => ['required', 'numeric'],
            'remarks' => ['required', 'string'],
            'reference_id' => ['required', 'string']
        ];
    }

    public function attributes()
    {
        return [
            'current_balance' => 'Current Balance'
        ];
    }
}
