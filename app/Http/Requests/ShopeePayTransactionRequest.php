<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShopeePayTransactionRequest extends FormRequest
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
            'shopee_pay_id' => ['required', 'numeric', 'exists:shopee_pays,id'],
            'date_time' => ['required', 'string'],
            'transact_type_id' => ['required', 'numeric', 'gt:0'],
            'description' => ['required', 'string'],
            'current_balance' => ['required', 'numeric'],
            'amount' => ['required', 'numeric'],
            'post_balance' => ['required', 'numeric'],
            'remarks' => ['required', 'string'],
            'order_sn' => ['required', 'string'],
            'reference_id' => ['required', 'string']
        ];
    }
}
