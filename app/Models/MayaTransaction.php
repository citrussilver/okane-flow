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
        'current_maya_balance',
        'amount',
        'post_maya_balance',
        'remarks',
        'reference_id'
    ];
}
