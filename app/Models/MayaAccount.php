<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
