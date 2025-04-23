<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SavingsAccount extends Model
{
    /** @use HasFactory<\Database\Factories\SavingsAccountFactory> */
    use HasFactory;

    protected $fillable = [
        'bank_name',
        'bank_abbrev',
        'account_number',
        'balance'
    ];

    public $timestamps = false;

    // public function sa_transactions(): HasMany
    // {
    //     return $this->hasMany(SaTransaction::class);
    // }
}
