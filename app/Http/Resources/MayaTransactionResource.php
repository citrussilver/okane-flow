<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MayaTransactionResource extends JsonResource
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
            'maya_id' => $this->maya_id,
            'date_time' => $this->date_time,
            'transact_type_id' => $this->transact_type_id,
            'current_maya_balance' => $this->current_maya_balance,
            'current_maya_balance_wc' => number_format($this->current_maya_balance, 2, '.', ','),
            'amount' => $this->amount,
            'amount_wc' => number_format($this->amount, 2, '.', ','),
            'post_maya_balance' => $this->post_maya_balance,
            'post_maya_balance_wc' => number_format($this->post_maya_balance, 2, '.', ','),
            'remarks' => $this->remarks,
            'reference_id' => $this->reference_id
        ];
    }
}
