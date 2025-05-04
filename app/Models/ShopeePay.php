<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopeePay extends Model
{
    /** @use HasFactory<\Database\Factories\ShopeePayFactory> */
    use HasFactory;

    protected $fillable = [
        'shopee_username',
        'balance'
    ];
}
