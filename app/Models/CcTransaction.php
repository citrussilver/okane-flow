<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CcTransaction extends Model
{
    /** @use HasFactory<\Database\Factories\CcTransactionFactory> */
    use HasFactory;

    protected $fillable = [
        'credit_card_id',
        'date_time',
        'transact_type_id',
        'description',
        'current_credit_limit',
        'amount',
        'post_credit_limit',
        'remarks',
        'ref_no'
    ];

    public function credit_card()
    {
        return $this->hasOne(CreditCard::class, 'id', 'credit_card_id');
    }
}
