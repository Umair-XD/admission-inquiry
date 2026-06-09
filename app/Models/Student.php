<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'name',
        'age',
        'mobile',
        'cnic',
        'address',
        'password',
        'matric_marks',
        'part1_marks',
        'part2_marks',
        'entry_test_marks',
    ];

    protected $hidden = ['password'];
}
