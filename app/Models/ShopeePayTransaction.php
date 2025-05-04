<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopeePayTransaction extends Model
{
    /** @use HasFactory<\Database\Factories\ShopeePayTransactionFactory> */
    use HasFactory;

    protected $fillable = [
        'shopee_pay_id',
        'date_time',
        'transact_type_id',
        'description',
        'current_balance',
        'amount',
        'post_balance',
        'remarks',
        'order_sn',
        'reference_id'
    ];

    public function shopee_pay()
    {
        return $this->hasOne(ShopeePay::class, 'id', 'shopee_pay_id');
    }
}
