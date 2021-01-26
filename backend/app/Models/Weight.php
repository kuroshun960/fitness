<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Weight extends Model
{
    protected $fillable = ['weight'];


    public function dates()
    {
        return $this->belongsTo(Date::class);
    }
    
}
