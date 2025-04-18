<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MayaAccountResource extends JsonResource
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
            'mobile_number' => $this->mobile_number,
            'account_nickname' => $this->account_nickname,
            'last_4_digits' => $this->last_4_digits,
            'balance' => $this->balance,
            'balance_wc' => number_format($this->balance, 2, '.', ',')
        ];
    }
}
