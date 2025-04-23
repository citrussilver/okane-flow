<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SavingsAccountResource extends JsonResource
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
            'bank_name' => $this->bank_name,
            'bank_abbrev' => $this->bank_abbrev,
            'account_number' => $this->account_number,
            'balance' => $this->balance,
            'balance_wc' => number_format($this->balance, 2, '.', ',')
        ];
    }
}
