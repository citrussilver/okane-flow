<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CcTransactionRequest extends FormRequest
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
            'credit_card_id' => ['required', 'numeric', 'exists:credit_cards,id'],
            'date_time' => ['required', 'string'],
            'description' => ['required', 'string'],
            'transact_type_id' => ['required', 'numeric', 'gt:0'],
            'current_credit_limit' => ['required', 'numeric'],
            'amount' => ['required', 'numeric'],
            'post_credit_limit' => ['required', 'numeric'],
            'remarks' => ['required', 'string'],
            'ref_no' => ['required', 'string']
        ];
    }
}
