<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->hasMany(User::class, 'university_id', 'id');
    }
    
    public function faculities()
    {
        return $this->hasMany(Faculity::class, 'university_id', 'id');
    }
}
