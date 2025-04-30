<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MayaTransaction extends Model
{
    /** @use HasFactory<\Database\Factories\MayaTransactionFactory> */
    use HasFactory;

    protected $fillable = [
        'maya_id',
        'date_time',
        'transact_type_id',
        'current_balance',
        'amount',
        'post_balance',
        'remarks',
        'reference_id'
    ];

    public function maya_account()
    {
        return $this->hasOne(MayaAccount::class, 'id', 'maya_id');
    }
}
