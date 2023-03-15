<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Myinvestment extends Model
{
    use HasFactory;
    protected $fillable = [
        'plan_name',
        'amount',
        'duration',
        'status',
        'gateway',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
