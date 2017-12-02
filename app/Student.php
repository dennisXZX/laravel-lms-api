<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'gender'
    ];

    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }
}
