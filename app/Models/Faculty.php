<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'personal_email',
        'official_email',
        'phone',
        'designation',
        'degree',
        'experience',
        'specialization',
        'profile_picture',
    ];
}
