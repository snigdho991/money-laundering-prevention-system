<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
    	'agency_user_id',
        'company_name',
        'responsible',
        'phone',
        'status',
    ];
}
