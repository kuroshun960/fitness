<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'kcalParday',
        'kcalParweek',
        'IncreaseOrDecrease',
        'HardOrSoft',
        'age',
        'sex',
        'height',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];



    public function dates()
    {
        return $this->hasMany(Date::class);
    }

    public function weights()
    {
        return $this->hasMany(Weight::class);
    }

    public function protainsetting()
    {
        return $this->hasMany(Protainsetting::class);
    }

    public function protaintasks()
    {
        return $this->hasMany(Protaintask::class);
    }

    public function meals()
    {
        return $this->hasMany(Meals::class);
    }

    public function eats()
    {
        return $this->hasMany(Eats::class);
    }
    

    //テストコードサンプル

    public function add($num1, $num2)
    {
        return $num1 + $num2;
    }





}
