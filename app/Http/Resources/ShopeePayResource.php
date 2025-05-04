<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShopeePayResource extends JsonResource
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
            'shopee_username' => $this->shopee_username,
            'balance' => $this->balance,
            'balance_wc' => number_format($this->balance, 2, '.', ',')
        ];
    }
}
