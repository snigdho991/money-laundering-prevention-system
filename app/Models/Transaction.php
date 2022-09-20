<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
    	'transaction_id',
        'customer_id',
        'company_id',
        'type',
        'amount',
        'beneficiary',
        'fee',
        'photo',
        'status',
    ];
}
