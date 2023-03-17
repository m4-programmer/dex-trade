<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\InvestmentPlan;

class Myinvestment extends Model
{
    use HasFactory;
    protected $fillable = [
        'plan_id',
        'plan_name',
        'amount',
        'duration',
        'roi',
        'status',
        'gateway',
        'transaction_id',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function plan()
    {
        return $this->belongsTo(InvestmentPlan::class);
    }
}
