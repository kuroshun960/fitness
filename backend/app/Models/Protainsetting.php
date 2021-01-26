<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Protainsetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'kcal',
        'carbo',
        'protain',
        'name',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
