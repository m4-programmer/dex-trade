<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdraw extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'amount',
        'withdraw_method',
        'wallet_address',
        'account_info',
        'additional_info',
        'network',
        'status',
        'transaction_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
