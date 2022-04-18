<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    public function faculity()
    {
        return $this->belongsTo(Faculty::class, 'faculity_id', 'id');
    }

    public function slides()
    {
        return $this->hasMany(Slide::class, 'department_id', 'id');
    }
}
