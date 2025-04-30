<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaTransaction extends Model
{
    /** @use HasFactory<\Database\Factories\SaTransactionFactory> */
    use HasFactory;

    protected $fillable = [
        'sa_account_id',
        'date_time',
        'transact_type_id',
        'current_balance',
        'amount',
        'post_balance',
        'location',
        'remarks',
        'reference_number'
    ];

    public function savings_account()
    {
        return $this->hasOne(SavingsAccount::class, 'id', 'sa_account_id');
    }
}
