<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
