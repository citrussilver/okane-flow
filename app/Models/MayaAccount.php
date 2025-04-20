<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MayaAccount extends Model
{
    /** @use HasFactory<\Database\Factories\MayaAccountFactory> */
    use HasFactory;

    protected $fillable = [
        'mobile_number',
        'account_nickname',
        'last_4_digits',
        'balance'
    ];

    public $timestamps = false;

    // public function maya_transactions(): HasMany
    // {
    //     return $this->hasMany(MayaTransaction::class);
    // }
}
