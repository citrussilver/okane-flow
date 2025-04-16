<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditCard extends Model
{
    /** @use HasFactory<\Database\Factories\CreditCardFactory> */
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'last_4_digits',
        'cc_name',
        'credit_limit',
        'avail_credit_limit'
    ];
}
