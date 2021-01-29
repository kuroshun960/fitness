<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Protaintask extends Model
{
    use HasFactory;


    protected $fillable = [
        'cups',
        'kcal',
        'protain',
        'carbo',
        'fat',
        'KcalPardayAtThatTime',

    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
