<?php

namespace App\Http\Resources;

use App\Models\CreditCard;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CcTransactionResource extends JsonResource
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
            'credit_card' => CreditCard::where('id', $this->credit_card_id)->exists() ? CreditCardResource::make($this->credit_card) : null,
            'date_time_em' => date("F d, Y h:m a", strtotime($this->date_time)),
            'date_time' => date("Y-m-d h:m", strtotime($this->date_time)),
            'description' => $this->description,
            'transact_type_id' => $this->transact_type_id,
            'current_credit_limit' => $this->current_credit_limit,
            'current_credit_limit_wc' => number_format($this->current_credit_limit, 2, '.', ','),
            'amount' => $this->amount,
            'amount_wc' => number_format($this->amount, 2, '.', ','),
            'post_credit_limit' => $this->post_credit_limit,
            'post_credit_limit_wc' => number_format($this->post_credit_limit, 2, '.', ','),
            'remarks' => $this->remarks,
            'ref_no' => $this->ref_no
        ];
    }
}
