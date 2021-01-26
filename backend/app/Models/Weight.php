<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Weight extends Model
{
    protected $fillable = ['weight'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
