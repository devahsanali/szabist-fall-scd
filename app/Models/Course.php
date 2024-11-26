<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'title',
        'credit_hrs'
    ];

    public function students()
    {
        return $this->belongsToMany(Student::class, Enrollment::class);
    }
}
