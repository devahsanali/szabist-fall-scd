<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address'
    ];

    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
