<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Eats extends Model
{
    use HasFactory;

    protected $fillable = [
        
        'name',
        'price',
        'kcal',
        'protain',
        'carbo',
        'fat',

        'type',
        'piece',
        'gram',

        'name',
        'eatKcal',
        'eatProtain',
        'eatCarbo',
        'eatFat',
        'eatProtain',
        'eatNet',
        'eatPrice',
        'type',
        'KcalPardayAtThatTime',

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
