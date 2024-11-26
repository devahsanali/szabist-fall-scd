<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address'
    ];

    public function courses()
    {
        return $this->belongsToMany(Course::class, Enrollment::class);
    }
}
