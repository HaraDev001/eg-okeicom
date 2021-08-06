<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BankOther extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'bank_id',
        'financial_name',
        'branch_name',
        'branch_number',
        'other_type',
    ];
}
