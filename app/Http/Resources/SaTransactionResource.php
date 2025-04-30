<?php

namespace App\Http\Resources;

use App\Models\SavingsAccount;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SaTransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            // below is based on hasOne relationship
            'savings_acct' => SavingsAccount::where('id', $this->sa_account_id)->exists() ? SavingsAccountResource::make($this->savings_account) : null,
            'date_time_em' => date("F d, Y h:m a", strtotime($this->date_time)),
            'date_time' => date("Y-m-d h:m", strtotime($this->date_time)),
            'transact_type_id' => $this->transact_type_id,
            'current_balance' => $this->current_balance,
            'current_balance_wc' => number_format($this->current_balance, 2, '.', ','),
            'amount' => $this->amount,
            'amount_wc' => number_format($this->amount, 2, '.', ','),
            'post_balance' => $this->post_balance,
            'post_balance_wc' => number_format($this->post_balance, 2, '.', ','),
            'remarks' => $this->remarks,
            'location' => $this->location,
            'reference_number' => $this->reference_number
        ];
    }
}
