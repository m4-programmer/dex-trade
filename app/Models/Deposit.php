<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    use HasFactory;
    protected $fillable = [
        'transaction_id',
        'user_id',
        'amount',
        'gateway',
        'proof',
        'status',
        'payment_type',
        
    ];

    public function plan()
    {
        return $this->belongsTo(InvestmentPlan::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    

}
