<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'role_as',
        'referral_id',
        'current_plan',
        'image'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function network(){
        return $this->hasMany(Network::class);
    }
    public function deposits(){
        return $this->hasMany(Deposit::class);
    }
    public function payments(){
        return $this->hasMany(Myinvestment::class);
    }
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
     public function withdrawal()
    {
        return $this->hasMany(withdraw::class);
    }
    

}
