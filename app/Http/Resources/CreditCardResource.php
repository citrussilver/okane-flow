<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CreditCardResource extends JsonResource
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
            'last_4_digits' => $this->last_4_digits,
            'cc_name' => $this->cc_name,
            'credit_limit' => $this->credit_limit,
            'avail_credit_limit' => $this->avail_credit_limit,
            'avail_credit_limit_wc' => number_format($this->avail_credit_limit, 2, '.', ',')
        ];
    }
}
