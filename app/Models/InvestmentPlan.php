<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvestmentPlan extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'minimum_amount',
        'maximum_amount',
        'roi',
        'duration',
        'capital_back',
        'status',
        'updated_at'
    ];
}
