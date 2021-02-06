<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meals extends Model
{
    use HasFactory;



    protected $fillable = [
        
        'name',
        'price',
        'kcal',
        'protain',
        'carbo',
        'fat',
        'item_photo_path',

        'type',
        'piece',
        'gram',

        'name',
        'eatKcal',
        'eatProtain',
        'eatCarbo',
        'eeatFat',
        'eatProtain',
        'eatNet',
        'type',
        

    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }




}
