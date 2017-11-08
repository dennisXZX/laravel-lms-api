<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lecturer extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'title',
        'email',
        'introduction'
    ];

    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }
}
