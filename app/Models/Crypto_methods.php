<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crypto_methods extends Model
{
    use HasFactory;
     psrotected $fillable = [
        'cryptocurrency',
        'wallet_address',
        'qr_code',
        'blockchain_network',
        'image',
        'short_name',
        'status',
    ];
}
