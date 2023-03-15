<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Network extends Model
{
    use HasFactory;
    protected $fillable = [
        'referral_id',
        'user_id',
        'ref_id',
        'amount_earned'
    ];
}
